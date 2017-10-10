<?php

/**
 * @link https://github.com/masterklavi/coyoteugly/
 * @license http://opensource.org/licenses/MIT MIT License
 */

namespace coyoteugly\interfaces;

/**
 * Interface of Human
 * 
 * @author <masterklavi@gmail.com>
 */
interface Human
{
    /**
     * Construct a Human
     * @param string $name
     */
    public function __construct(string $name);
    
    /**
     * Returns name of the human
     * @return string
     */
    public function getName() : string;
}
