<?php

namespace CodeStop\Proof\SelectorParser\Handler;

use CodeStop\Proof\SelectorParser\SourceReader;
use CodeStop\Proof\SelectorParser\TokenStream;

/**
 * The comma character handler for the parser. Creates a comma token and push it to the TokenStream.
 */
class CommaHandler implements HandlerInterface
{
    public function handle(SourceReader $reader, TokenStream $stream)
    {
        $char = $reader->getCurrentChar();
        if ($char !== ",") {
            return false;
        }

        $reader->movePosition(1);

        $stream->push($this->getType(), $char);

        return true;
    }

    public function getType()
    {
        return 'comma';
    }
}
