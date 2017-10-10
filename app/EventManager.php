<?php

/**
 * @link https://github.com/masterklavi/coyoteugly/
 * @license http://opensource.org/licenses/MIT MIT License
 */

namespace coyoteugly;

/**
 * EventManager
 * 
 * @author <masterklavi@gmail.com>
 */
class EventManager implements \coyoteugly\interfaces\EventManager
{
    /**
     * Array of Listeners
     * @var array
     */
    protected static $listeners = [];
    
    /**
     * {@inheritDoc}
     */
    public static function addListener(string $event_name, \coyoteugly\interfaces\EventListener $listener)
    {
        isset(self::$listeners[$event_name]) OR self::$listeners[$event_name] = [];
        self::$listeners[$event_name][] = $listener;
    }

    /**
     * {@inheritDoc}
     */
    public static function trigger(string $event_name, $data = null)
    {
        if (isset(self::$listeners[$event_name]))
        {
            foreach (self::$listeners[$event_name] as $listener)
            {
                $listener->trigger($event_name, $data);
            }
        }
    }
}
