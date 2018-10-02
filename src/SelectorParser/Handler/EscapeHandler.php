<?php

namespace CodeStop\Proof\SelectorParser\Handler;

use CodeStop\Proof\SelectorParser\SourceReader;
use CodeStop\Proof\SelectorParser\TokenStream;

/**
 * The escape character handler for the parser. Creates a quote token and push it to the TokenStream.
 */
class EscapeHandler implements HandlerInterface
{
    public function handle(SourceReader $reader, TokenStream $stream)
    {
        $char = $reader->getCurrentChar();
        $next = $reader->getNextChar();
        if ($char === '\\' && ($next === "'" || $next === '"')) {
            $reader->movePosition(1);

            return true;
        }

        return false;
    }

    public function getType()
    {
        return 'escape';
    }
}
