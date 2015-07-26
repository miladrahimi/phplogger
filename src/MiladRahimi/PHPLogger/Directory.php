<?php namespace MiladRahimi\PHPLogger;

/**
 * Class Directory
 * This class implements Storage interface to be used in Logger class.
 * Directory is a storage which stores logs into a directory.
 *
 * @package MiladRahimi\Logger
 * @author Milad Rahimi <info@miladrahimi.com>
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
     * @param string $name
     * @param string $content
     * @return bool
     * @throws PHPLoggerException
     */
    public function store($name, $content)
    {
        $path = realpath($this->path);
        if (!is_dir($path) || !is_writable($path))
            throw new PHPLoggerException("Non-writable log directory path");
        if (!isset($name) || !preg_match("/^[A-Za-z0-9\.\_\-]+$/", $name))
            throw new InvalidArgumentException("Bad log name");
        $fn = $path . DIRECTORY_SEPARATOR . $name . '.' . (empty($this->extension) ? 'log' : $this->extension);
        $fp = fopen($fn, "a+");
        if (!is_resource($fp))
            throw new PHPLoggerException("Cannot create the log file");
        fclose($fp);
        $fc = file_get_contents($fn);
        if ($fc === false)
            $fc = "";
        $r = file_put_contents($fn, $content . $fc);
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
            throw new InvalidArgumentException("Non-string extension");
        if(strlen($extension) < 1 || strlen($extension) > 9)
            throw new InvalidArgumentException("Extension length must be between 1 and 9 char");
        $this->extension = trim((string)$extension);
    }

}