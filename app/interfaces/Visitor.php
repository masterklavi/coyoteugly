<?php

/**
 * @link https://github.com/masterklavi/coyoteugly/
 * @license http://opensource.org/licenses/MIT MIT License
 */

namespace coyoteugly\interfaces;

use coyoteugly\interfaces\Dance;

/**
 * Interface of Visitor
 * 
 * @author <masterklavi@gmail.com>
 */
interface Visitor
{
    // Placement of the visitor
    const PLACE_BAR = 0;
    const PLACE_DANCEFLOOR = 1;
    
    /**
     * Returns array of dances visitor can dance
     * @return array
     */
    public function getCanDance() : array;
    
    /**
     * Sets array of dances visitor can dance
     * @param array $canDance
     */
    public function setCanDance(array $canDance);
    
    /**
     * Returns current dance
     * @return mixed
     */
    public function getDance();
    
    /**
     * Sets current dance
     * @param mixed $dance
     */
    public function setDance($dance);
    
    /**
     * Returns current place
     * @return int
     */
    public function getPlace() : int;
    
    /**
     * Sets current place
     * @param int $place
     */
    public function setPlace(int $place);
    
    /**
     * Returns visitor state (placement of body parts)
     * @return array
     */
    public function getState() : array;
    
    /**
     * Sets visitor state
     * @param array $place
     */
    public function setState(array $place);
    
    /**
     * Returns current View of the visitor
     * @return mixed
     */
    public function getView();
}
