<?php namespace MiladRahimi\PHPLogger;

/**
 * Interface Storage
 * All logger storage like Directory and Database must implements this interface.
 *
 * @package MiladRahimi\Logger
 * @author Milad Rahimi <info@miladrahimi.com>
 */
interface Storage {

    /**
     * Store the log into the appropriate storage
     *
     * @param string $name : Name e.g. log level
     * @param string $content : Content to store
     * @return bool : Success
     */
    public function store($name, $content);

}