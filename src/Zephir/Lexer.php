<?php

namespace Zephir2Php\Zephir;

class Lexer
{
    /** @var string */
    protected $source;

    /** @var int */
    protected $position;

    public function __construct($source='') {
        $this->setSource($source);
    }

    public function setSource($source) {
        $this->source = $source;
        $this->position = 0;
    }

    public function nextToken() {
        $token = Token::match(substr($this->source, $this->position));
        if($token) {
            $this->position += $token->getLength();
        }
        return $token;
    }

}
