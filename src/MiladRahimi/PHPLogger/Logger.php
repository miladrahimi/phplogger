<?php namespace MiladRahimi\PHPLogger;

use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;

/**
 * Class Logger
 *
 * Logger class is the main package class.
 * This class forms the log contents then store them via added storage classes.
 *
 * @package MiladRahimi\PHPLogger
 *
 * @author Milad Rahimi <info@miladrahimi.com>
 */
class Logger extends AbstractLogger
{
    /**
     * Storage Object to store logs in its provided space
     *
     * @var array
     */
    protected $storage = array();

    /**
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     * @return null|void
     */
    public function log($level, $message, array $context = array())
    {
        if (!isset($level) || !is_scalar($level))
            throw new InvalidArgumentException("Invalid level");
        if (!isset($message) || !is_scalar($message) || (is_object($message) && !method_exists($message, "__toString")))
            throw new InvalidArgumentException("Non-string message");
        if (!is_array($context) && !is_object($context))
            throw new InvalidArgumentException("Non-array context");
        if (empty($this->storage))
            throw new InvalidArgumentException("No storage to store");
        /** @var Storage $storage */
        foreach ($this->storage as $storage) {
            $storage->store($level, $message, $context);
        }
    }

    public function addStorage(Storage $storage)
    {
        if (!$storage instanceof Storage)
            throw new InvalidArgumentException("Invalid storage object");
        array_push($this->storage, $storage);
    }
}