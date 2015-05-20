<?php namespace Neatplex\PHPLogger;

/*
------------------------------------------------------------
Logger Class (2015/5/12)
------------------------------------------------------------
Logger class is implementation of PSR-3 abstract logger.
------------------------------------------------------------
http://neatplex.com/project/phplogger/1.0/about/phplogger
------------------------------------------------------------
*/

use Psr\Log\AbstractLogger;
use Psr\Log\InvalidArgumentException;

/**
 * Class Logger
 *
 * @package Neatplex\Logger
 */
class Logger extends AbstractLogger
{
    /**
     * Storage Object to store logs in its provided space
     *
     * @var Directory
     */
    protected $storage;

    /**
     * Constructor
     *
     * @param Storage $stock
     */
    public function __construct(Storage $stock = null)
    {
        if ($stock != null)
            $this->setStorage($stock);
    }

    /**
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     * @return null|void
     */
    public function log($level, $message, array $context = array())
    {
        if (empty($level))
            throw new InvalidArgumentException("Neatplex Logger, Error 1011: Invalid log level.");
        if (!is_string($message) && (!is_object($message) || !method_exists($message, "__toString")))
            throw new InvalidArgumentException("Neatplex Logger, Error 1012: Non-string log message");
        if (!is_array($context))
            throw new InvalidArgumentException("Neatplex Logger, Error 1013: Non-array log context");
        if (!($this->storage instanceof Directory))
            throw new InvalidArgumentException("Neatplex Logger, Error 1014: Undefined or Invalid Storage");
        $this->storage->store($level, $message, $context);
    }

    /**
     * @return Storage
     */
    public function getStorage()
    {
        return $this->storage;
    }

    /**
     * @param Storage $storage
     */
    public function setStorage($storage)
    {
        $this->storage = $storage;
    }
}