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
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     * @return null|void
     * @throws InvalidArgumentException
     */
    public function log($level, $message, array $context = array())
    {
        $this->validate($level, $message, $context);
        $message = "MESSAGE:\r\n" . (empty($message) ? "[ NOT SET ]" : trim($message)) . "\r\n";
        $message .= "CONTEXT:\r\n" . (empty($context) ? "[ NOT SET ]" : print_r($context, true)) . "\r\n";
        $message .= "### Logged by PHPLogger @ " . date("Y/m/d H:i") . "\r\n\r\n";
        /** @var Storage $storage */
        foreach ($this->storage as $storage) {
            $storage->store($level, $message, $context);
        }
    }

    /**
     * Validate given data to log
     *
     * @param $level
     * @param $message
     * @param array $context
     */
    private function validate($level, $message, array $context = array())
    {
        if (!array_key_exists($level, $this->logLevels))
            throw new InvalidArgumentException("Invalid level");
        if (!isset($message) || !is_scalar($message) || (is_object($message) && !method_exists($message, "__toString")))
            throw new InvalidArgumentException("Non-string message");
        if (!is_array($context) && !is_object($context))
            throw new InvalidArgumentException("Non-array context");
        if (empty($this->storage))
            throw new InvalidArgumentException("No storage to store");
    }

    /**
     * Add a new storage
     *
     * @param Storage $storage
     *
     * @throws InvalidArgumentException
     */
    public function addStorage(Storage $storage)
    {
        array_push($this->storage, $storage);
    }
}