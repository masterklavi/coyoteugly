<?php

/**
 * @link https://github.com/masterklavi/coyoteugly/
 * @license http://opensource.org/licenses/MIT MIT License
 */

namespace coyoteugly\interfaces;

/**
 * Interface of EventManager
 * 
 * @author <masterklavi@gmail.com>
 */
interface EventManager
{
    /**
     * Subscribes listener
     * @param string $event_name
     * @param \coyoteugly\interfaces\EventListener $listener
     */
    public static function addListener(string $event_name, EventListener $listener);
    
    /**
     * Triggers event
     * @param string $event_name
     * @param mixed $data
     */
    public static function trigger(string $event_name, $data = null);
}
