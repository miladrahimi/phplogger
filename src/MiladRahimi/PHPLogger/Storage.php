<?php namespace MiladRahimi\PHPLogger;

/**
 * Interface Storage
 *
 * All logger storage like Directory and Database must implements this interface.
 *
 * @package MiladRahimi\Logger
 */
interface Storage {

    /**
     * Store the log into the appropriate storage
     *
     * @param string $level
     * @param string|Object $message
     * @param array|Object $context
     */
    public function store($level, $message, $context);

}