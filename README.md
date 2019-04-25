# zephir2php
Convert Zephir source files to regular PHP

# How to use
1. Install package via composer
2. Include package in the project
3. Create file or add somewhere in the project code to work with zephir sources

# Documentation

The main package class is Zephir2Php\Converter:

Functions:
<br>setSource( string $directory ) - source directory with *.zep files

getSource( void ) - returns source directory

setTarget( string $directory ) - target directory, to store the output *.php files

getTarget( void ) - returns target directory

run( void ) - run the converter

**the set-- functions is also returns $this, so it can be used like that:
<br>(new Zephir2PHP\Converter())->setSource('mysource_zep')->setTarget('mysource')->run();**
