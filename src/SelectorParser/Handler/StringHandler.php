<?php

namespace CodeStop\Proof\SelectorParser\Handler;

use CodeStop\Proof\SelectorParser\SourceReader;
use CodeStop\Proof\SelectorParser\TokenStream;

/**
 * The default handler for the parser. Creates a string token and push it to the TokenStream.
 */
class StringHandler implements HandlerInterface
{
    public function handle(SourceReader $reader, TokenStream $stream)
    {
        $char = $reader->getCurrentChar();
        $reader->movePosition(1);

        $stream->push($this->getType(), $char);

        return true;
    }

    public function getType()
    {
        return 'string';
    }
}