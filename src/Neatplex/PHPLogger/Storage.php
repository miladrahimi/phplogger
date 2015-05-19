<?php namespace Neatplex\PHPLogger;

/*
------------------------------------------------------------
Storage Interface (2015/5/12)
------------------------------------------------------------
Storage interface is the standard interface for the classes
which provide storage (a place to store) for PHPLogger class.
------------------------------------------------------------
http://neatplex.com/project/phplogger/1.0/about/storage
------------------------------------------------------------
*/

/**
 * Interface Storage
 * @package Neatplex\PHP\PHPLogger
 */
interface Storage {

    /**
     * Store the log into the appropriate storage
     *
     * @param $level
     * @param $message
     * @param $context
     * @return void
     */
    public function store($level, $message, $context);

}