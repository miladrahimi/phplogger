<?php namespace MiladRahimi\PHPLogger;

use MiladRahimi\PHPLogger\Exceptions\DirectoryNotWritableException;
use MiladRahimi\PHPLogger\Exceptions\FileNotWritableException;
use MiladRahimi\PHPLogger\Exceptions\InvalidArgumentException;

/**
 * Class Directory
 * Directory class implements Storage interface to be used in Logger class.
 * Directory is a storage which stores logs into a directory.
 *
 * @package MiladRahimi\Logger
 * @author  Milad Rahimi <info@miladrahimi.com>
 */
class Directory implements Storage {

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
    public function __construct($path = null) {
        if (null !== $path) {
            $this->setPath($path);
        }
    }

    /**
     * Store logged message into a file
     *
     * @param string $name    : Log name (level)
     * @param string $content : Log content
     *
     * @return bool : success
     * @throws DirectoryNotWritableException
     * @throws FileNotWritableException
     */
    public function store($name, $content) {
        $path = realpath($this->path);
        if (!is_dir($path) || !is_writable($path)) {
            throw new DirectoryNotWritableException("Directory is not writable");
        }
        if (!isset($name) || !preg_match("/^[A-Za-z0-9\.\_\-]+$/", $name)) {
            throw new InvalidArgumentException("Bad log name");
        }
        $fn = $path . DIRECTORY_SEPARATOR . $name . '.' . (empty($this->extension) ? 'log' : $this->extension);
        $fp = fopen($fn, "a+");
        if (!is_resource($fp)) {
            throw new FileNotWritableException("Cannot create the log file");
        }
        fclose($fp);
        $fc = file_get_contents($fn);
        if ($fc === false) {
            $fc = "";
        }
        $r = file_put_contents($fn, $content . $fc);
        if ($r === false) {
            throw new FileNotWritableException("Cannot write into log file");
        }
    }

    /**
     * @return string
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path) {
        if (!isset($path) || !is_scalar($path)) {
            throw new InvalidArgumentException("Path must be a string value");
        }
        $this->path = trim((string)$path);
    }

    /**
     * @return string
     */
    public function getExtension() {
        return $this->extension;
    }

    /**
     * @param string $extension
     */
    public function setExtension($extension) {
        if (!isset($extension) || !is_scalar($extension)) {
            throw new InvalidArgumentException("Extension must be a string value");
        }
        if (strlen($extension) < 1 || strlen($extension) > 9) {
            throw new InvalidArgumentException("Extension length must be between 1 and 9 char");
        }
        $this->extension = trim((string)$extension);
    }

}