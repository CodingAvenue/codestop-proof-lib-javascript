<?php

namespace CodeStop\Proof\SelectorParser\Rule;

use CodeStop\Proof\SelectorParser\Token;
use CodeStop\Proof\SelectorParser\TokenStream;

interface RuleInterface
{
    public function startToken(Token $token);

    public function endToken(Token $token);

    public function unexpectedToken(Token $token);

    public function handle(TokenStream $token); 

    public function getRuleType();  
}
