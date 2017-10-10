<?php

/**
 * @link https://github.com/masterklavi/coyoteugly/
 * @license http://opensource.org/licenses/MIT MIT License
 */

namespace coyoteugly\interfaces;

/**
 * Interface of EventListener
 * 
 * @author <masterklavi@gmail.com>
 */
interface EventListener
{
    /**
     * Listener reaction when Event is triggered
     * @param string $event_name
     * @param mixed $data
     */
    public function trigger(string $event_name, $data = null);
}
