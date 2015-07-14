<?php namespace MiladRahimi\PHPLogger;

/*
------------------------------------------------------------
Directory Class (2015/5/12)
------------------------------------------------------------
Directory class holds information of directory and files which
going to keep the content of logs.
It implements Storage interface.
------------------------------------------------------------
http://neatplex.com/project/phplogger/1.0/about/directory
------------------------------------------------------------
*/

use Psr\Log\InvalidArgumentException;

/**
 * Class Directory
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
     * Storage Path to store logs
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
            throw new InvalidArgumentException("MiladRahimi PHPLogger, Error 1015: Non-writable log directory.");
        if (!preg_match("/^[A-Za-z0-9\.\_\-]+$/", $level))
            throw new InvalidArgumentException("MiladRahimi PHPLogger, Error 1016: Bad name for log level.");
        $message = "MESSAGE:\r\n" . (empty($message) ? "[ NOT SET ]" : trim($message)) . " \r\n";
        $message .= "CONTEXT:\r\n" . (empty($context) ? "[ NOT SET ]" : print_r($context, true)) . " \r\n";
        $message .= "### Logged by MiladRahimi Logger @ " . date("Y/m/d H:i") . " \r\n\r\n";
        $fn = $path . DIRECTORY_SEPARATOR . $level . '.' . (empty($this->extension) ? 'log' : $this->extension);
        $fp = fopen($fn, "a+");
        if (!is_resource($fp))
            throw new \Exception("MiladRahimi PHPLogger, Error 1017: Cannot create the log file.");
        fclose($fp);
        $fc = file_get_contents($fn);
        if ($fc === false)
            $fc = "";
        $r = file_put_contents($fn, $message . $fc);
        if ($r === false)
            throw new \Exception("MiladRahimi PHPLogger, Error 1018: Non-writable log file.");
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
        $this->path = empty($path) ? null : trim($path);
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
        $this->extension = empty($extension) ? null : trim($extension);
    }

}