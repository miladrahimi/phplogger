<?php namespace MiladRahimi\PHPLogger;

use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;

/**
 * Class Logger
 * Logger class forms the log contents then store them via added storage classes.
 *
 * @package MiladRahimi\PHPLogger
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
     * Log Levels
     *
     * @var array
     */
    private $logLevels = array(
        LogLevel::EMERGENCY => 0,
        LogLevel::ALERT => 1,
        LogLevel::CRITICAL => 2,
        LogLevel::ERROR => 3,
        LogLevel::WARNING => 4,
        LogLevel::NOTICE => 5,
        LogLevel::INFO => 6,
        LogLevel::DEBUG => 7
    );

    /**
     * Constructor
     *
     * @param Storage|null $storage
     */
    public function __construct(Storage $storage = null)
    {
        if ($storage !== null)
            $this->addStorage($storage);
    }

    /**
     * Log!
     *
     * @param string $level : Log level
     * @param string $message : Log message
     * @param array $context : Log context (extra information)
     * @return null|void
     * @throws InvalidArgumentException
     */
    public function log($level, $message, array $context = array())
    {
        if (!isset($level) || !array_key_exists($level, $this->logLevels))
            throw new InvalidArgumentException("Level is not valid");
        if (!isset($message) || !is_scalar($message) || (is_object($message) && !method_exists($message, "__toString")))
            throw new InvalidArgumentException("Message must be a string value");
        if (empty($this->storage))
            throw new InvalidArgumentException("No storage to store");
        $content = "MESSAGE:\r\n" . (empty($message) ? "[EMPTY]" : trim($message)) . "\r\n";
        $content .= "CONTEXT:\r\n" . (empty($context) ? "[EMPTY]" : print_r($context, true)) . "\r\n";
        $content .= "### Logged by PHPLogger @ " . date("Y/m/d H:i") . "\r\n\r\n";
        /** @var Storage $storage */
        foreach ($this->storage as $storage) {
            $storage->store($level, $content);
        }
    }

    /**
     * Add a new storage
     *
     * @param Storage $storage : Storage object
     * @throws InvalidArgumentException
     */
    public function addStorage(Storage $storage)
    {
        array_push($this->storage, $storage);
    }
}