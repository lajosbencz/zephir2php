<?php

namespace Zephir2Php;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Zephir2Php\Converter\Exception;

class Converter
{
    const EXT_ZEPHIR = 'zep';
    const TARGET_AUTO_APPEND = '-php';

    /** @var string */
    protected $source = null;

    /** @var string */
    protected $target = null;

    /** @var File\Iterator */
    protected $sourceIterator = null;

    public function __construct(...$args) 
    {
        switch( count($args) )
        {
            case 0:
                break;
            case 1:
                {
                    $this->setSource($args[0]);
                } break;
            default:
                {
                    $this->setSource($args[0]);
                    $this->setTarget($args[1]);
                } break;
        }
    }

    public function setSource($directory) {
        $directory = Path::directory($directory);
        if(!is_dir($directory)) {
            throw new Exception("Source directory does not exist: [{$directory}]");
        }
        $this->source = $directory;
        $di = new RecursiveDirectoryIterator($this->source);
        $ii = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);
        $this->sourceIterator = new File\Iterator($ii);
        return $this;
    }

    public function getSource() {
        return $this->source;
    }

    public function setTarget($directory) {
        $directory = Path::directory($directory);
        $this->target = $directory;
        return $this;
    }

    public function getTarget() {
        if(!$this->target && $this->source) {
            $this->target = $this->source.self::TARGET_AUTO_APPEND;
        }
        return $this->target;
    }

    public function getSourceIterator() {
        return $this->sourceIterator;
    }

    public function run() {
        /** @var RecursiveDirectoryIterator $i */
        foreach($this->getSourceIterator() as $i) {
            if(!$i->isFile() || $i->getExtension() !== self::EXT_ZEPHIR) {
                continue;
            }
            $file = new File($i->getRealPath());
            $lexer = new Zephir\Lexer($file->getSource());
            echo $i->getRealPath(), PHP_EOL;
            while($token = $lexer->nextToken()) {
                if($token->isComment() || $token->isWhiteSpace()) {
                    continue;
                }
                echo $token, PHP_EOL;
            }
            Terminal::readline();
        }
    }

}
