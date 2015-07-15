<?php namespace MiladRahimi\PHPLogger;

/**
 * Class Directory
 *
 * This class implements Storage interface to be used in Logger class.
 * Directory is a storage which stores logs into a directory.
 *
 * @package MiladRahimi\Logger
 */
class Directory implements Storage
{

    /**
     * Directory Path to store logs
     *
     * @var string
     */
    private $path;

    /**
     * Log file extensions which will be created
     * e.g. "log" or "txt"
     *
     * @var string
     */
    private $extension;

    /**
     * Constructor
     *
     * @param string $path
     */
    public function __construct($path = null)
    {
        if (null !== $path)
            $this->setPath($path);
    }

    /**
     * Store logged message into a file
     *
     * @param string $level
     * @param string|\Exception $message
     * @param array $context
     *
     * @throws \Exception
     */
    public function store($level, $message, $context)
    {
        $path = realpath($this->path);
        if (!is_dir($path) || !is_writable($path))
            throw new PHPLoggerException("Non-writable log directory path");
        if (!isset($level) || !preg_match("/^[A-Za-z0-9\.\_\-]+$/", $level))
            throw new InvalidArgumentException("Bad name for log level");
        $fn = $path . DIRECTORY_SEPARATOR . $level . '.' . (empty($this->extension) ? 'log' : $this->extension);
        $fp = fopen($fn, "a+");
        if (!is_resource($fp))
            throw new PHPLoggerException("Cannot create the log file");
        fclose($fp);
        $fc = file_get_contents($fn);
        if ($fc === false)
            $fc = "";
        $r = file_put_contents($fn, $message . $fc);
        if ($r === false)
            throw new PHPLoggerException("Non-writable log file");
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        if (!isset($path) || !is_scalar($path))
            throw new InvalidArgumentException("Non-string directory path");
        $this->path = trim((string)$path);
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param string $extension
     */
    public function setExtension($extension)
    {
        if (!isset($extension) || !is_scalar($extension))
            throw new InvalidArgumentException("Non-string directory path");
        $this->extension = trim((string)$extension);
    }

}