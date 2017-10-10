<?php

/**
 * @link https://github.com/masterklavi/coyoteugly/
 * @license http://opensource.org/licenses/MIT MIT License
 */

namespace coyoteugly\interfaces;

/**
 * Interface of Dance
 * 
 * @author <masterklavi@gmail.com>
 */
interface Dance
{
    /**
     * Constructor of new Dance
     * @param string $name
     * @param string $genre
     * @param array $dance
     */
    public function __construct(string $name, string $genre, array $dance);
    
    /**
     * Returns Name of Dance
     * @return string
     */
    public function getName() : string;
    
    /**
     * Returns Genre of Dance
     * @return string
     */
    public function getGenre() : string;
    
    /**
     * Returns Dance Motions of Dance
     * @return array
     */
    public function getDance() : array;
    
    /**
     * Changes Visitor state using Dance Motions
     * @param array $state
     * @return array
     */
    public function dance(array $state) : array;
}
