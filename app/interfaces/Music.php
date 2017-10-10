<?php

/**
 * @link https://github.com/masterklavi/coyoteugly/
 * @license http://opensource.org/licenses/MIT MIT License
 */

namespace coyoteugly\interfaces;

/**
 * Interface of Music
 * 
 * @author <masterklavi@gmail.com>
 */
interface Music
{
    /**
     * Construct Music
     * @param string $name
     * @param string $genre
     * @param int $duration seconds
     */
    public function __construct(string $name, string $genre, int $duration);
    
    /**
     * Returns Name
     * @return string
     */
    public function getName() : string;
    
    /**
     * Returns Genre
     * @return string
     */
    public function getGenre() : string;
    
    /**
     * Returns Duration
     * @return int
     */
    public function getDuration() : int;
}
