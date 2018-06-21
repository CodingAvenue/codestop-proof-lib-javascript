<?php

namespace CodeStop\Proof\SelectorParser\Handler;

use CodeStop\Proof\SelectorParser\TokenStream;
use CodeStop\Proof\SelectorParser\SourceReader;

interface HandlerInterface
{
    /**
     * parse the Reader's source from the reader's current position.
     * creates a new token and push it to the TokenStream if it can handle the source.
     * 
     * @param Reader the reader instance
     * @param TokenStream the token stream instance
     *
     * @return bool true if it can handle the reader's current position false otherwise.
     */
    public function handle(SourceReader $reader, TokenStream $stream);

    /**
     *
     */
    public function getType();
}
