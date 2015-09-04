<?php

namespace Zephir2Php;

use Zephir2Php\File\Exception;

class File
{
    /** @var string */
    protected $path;

    /** @var string */
    protected $source;

    public function __construct($path=null) {
        if($path) {
            $this->setPath($path);
        }
    }

    public function setPath($path) {
        $this->source = null;
        $path = Path::file($path);
        if(!is_file($path)) {
            throw new Exception("File does not exist: [{$path}]");
        }
        $this->path = $path;
        return $this;
    }

    public function getPath() {
        return $this->path;
    }

    public function getSource() {
        if(!$this->source) {
            $this->source = file_get_contents($this->path);
        }
        return $this->source;
    }
}
