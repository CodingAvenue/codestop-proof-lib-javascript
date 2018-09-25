<?php

namespace CodeStop\Proof\SelectorParser\Rule;

use CodeStop\Proof\SelectorParser\Token;
use CodeStop\Proof\SelectorParser\TokenStream;
use CodeStop\Proof\SelectorParser\Rule\RuleInterface;

class AttributeRule implements RuleInterface
{
    public function startToken(Token $token)
    {
        return $token->getType() === 'open_square_bracket';
    }

    public function endToken(Token $token)
    {
        return $token->getType() === 'close_square_bracket';
    }

    public function unexpectedToken(Token $token)
    {
        return false;
    }

    public function getRuleType()
    {
        return 'attribute';
    }

    public function handle(TokenStream $stream)
    {
        $token = $stream->getCurrentToken(); // Get the current cursor token and check if it satisfy this rule.

        if (!$this->startToken($token)) {
            throw new \Exception("Unsatisfied startToken rule detected. Current stream cursor is at token {$token->getValue()}");
        }

        $token = $stream->getNextToken(); //We move the cursor to the next Token ignoring the open bracket since we don't want that on the result

        $attribute = array();
        $keyMode = true;
        $attrKey = '';
        $attrVal = '';

        while(!$stream->isEnd()) {
            $token = $stream->getCurrentToken();
            if ($this->endToken($token)) {
                break;
            }

            if ($keyMode) {
                if ($token->getValue() === "=") {
                    // End of key
                    $attribute[$attrKey] = '';
                    $keyMode = false;
                }
                else {
                    $attrKey .= $token->getValue();
                }
            } else {
                if ($token->getType() === "quote") {
                    $nextToken = $stream->peekNextToken();
                    if (is_null($nextToken) || $nextToken->getType() === 'close_square_bracket' || ($nextToken->getType() === "comma" && strlen($attrVal) != 0)) {
                        // End of attr value.
                        $attribute[$attrKey] = $attrVal;
                        $attrKey = '';
                        $attrVal = '';
                        $keyMode = true;
                        while (!$stream->isEnd()) {
                            $tok = $stream->peekNextToken();
                            if ($this->endToken($tok)) {
                                break;
                            }

                            if ($tok->getValue() === 'string') {
                                break;
                            }

                            $toks = $stream->getNextToken();
                        }
                    } else {
                        $attrVal .= strlen($attrVal) == 0 ? '' : $token->getValue();
                    }
                } else {
                    $attrVal .= $token->getValue();
                }
            }

            $token = $stream->getNextToken();
        }

        //Check if the current Token satisfy the endToken()
        if (!$this->endToken($token)) {
            throw new \Exception("Expecting an close_square_bracket_token before the end of the stream");
        }

        $stream->getNextToken();

        return $attribute;
    }
}
