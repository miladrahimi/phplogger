<?php

use MiladRahimi\PHPLogger\Logger;
use Psr\Log\InvalidArgumentException;
use Psr\Log\LogLevel;
use MiladRahimi\PHPLogger\Directory;

class LoggerTest extends PHPUnit_Framework_TestCase
{
    public function testLevelValidation()
    {
        $this->setExpectedException('InvalidArgumentException');

        $logger = new Logger();
        $logger->log("Invalid_level", "Message");
    }

    public function testMessageValidation()
    {
        $this->setExpectedException('InvalidArgumentException');

        $logger  = new Logger();
        $storage = new Directory();
        $logger->addStorage($storage);

        $logger->log(LogLevel::CRITICAL, null);
    }
}