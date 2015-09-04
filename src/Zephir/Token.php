<?php

namespace Zephir2Php\Zephir;

class Token
{
    public static $NAME = [
        'CommentLine',
        'CommentMulti',
        'DocBlock',
        'WhiteSpace',
        'String',
        'Char',
        'BraceOpen',
        'BraceClose',
        'ParenthesisOpen',
        'ParenthesisClose',
        'BracketOpen',
        'BracketClose',
        'SemiColon',
        'TypeHint',
        'AccessInstance',
        'AccessStatic',
        'CompareStrict',
        'Compare',
        'Logical',
        'OperatorAssign',
        'OperatorBinary',
        'OperatorCrement',
        'Operator',
        'Number',
        'Expression',
        'Assign',
        'Unknown',
    ];
    public static $PATTERN = [
        '/^\/\/([^*].*)?$/m',
        '/^\/\*([^*].*?)\*\//s',
        '/^\/\*\*(.*?)\*\//s',
        '/^[\s]+/s',
        '/^"(((\\.)|([^"]))+)?"/s',
        '/^\'((\\.)|([^\']))?\'/s',
        '/^\{/',
        '/^\}/',
        '/^\(/',
        '/^\)/',
        '/^\[/',
        '/^\]/',
        '/^\;/',
        '/^\-\>\s+(\<([^\>]+)\>)|([^\s]+)/s',
        '/^\-\>/',
        '/^\:\:/',
        '/^[\!\=]\=\=/',
        '/^([\!\=]\=)/',
        '/^(\&|\||\^){2}/s',
        '/^[\+\-\*\/\.]\=/s',
        '/^[\&\|\^\~]/s',
        '/^(\+|\-){2}/',
        '/^[\+\-\*\/]/',
        '/^([\d]+(\.[\d]+)?)|(\.[\d]+)/',
        '/^[\$A-Z\_][A-Z0-9\_]*/i',
        '/^\=/',
        '/^./s',
    ];

    public static function match($source) {
        foreach(self::$PATTERN as $i=>$p) {
            if(preg_match($p, $source, $match)) {
                return new self(self::$NAME[$i], $match[0], $match);
            }
        }
        return null;
    }

    protected $name;
    protected $value;
    protected $length;
    protected $match = [];

    public function __construct($name, $value=null, $match=[]) {
        $this->name = $name;
        $this->value = $value;
        $this->length = strlen($value);
        $this->match = $match;
    }

    public function getName() {
        return $this->name;
    }

    public function getValue() {
        return $this->value;
    }

    public function getLength() {
        return $this->length;
    }

    public function getMatch() {
        return $this->match;
    }

    public function isWhiteSpace() {
        return $this->getName() == 'WhiteSpace';
    }

    public function isComment() {
        return $this->getName() == 'CommentSingle' || $this->getName() == 'CommentMulti' || $this->getName() == 'DocBlock';
    }

    public function __toString() {
        return '<'.$this->name.': ['.$this->value.']>';
    }

}
