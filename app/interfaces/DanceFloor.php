<?php

/**
 * @link https://github.com/masterklavi/coyoteugly/
 * @license http://opensource.org/licenses/MIT MIT License
 */

namespace coyoteugly\interfaces;

/**
 * Interface of DanceFloor
 * 
 * @author <masterklavi@gmail.com>
 */
interface DanceFloor
{    
    /**
     * Loads dances from file
     * @param string $filename
     */
    public function loadDances(string $filename);
    
    /**
     * Chooses dances by music
     * @param \coyoteugly\interfaces\Music $music
     * @return array
     */
    public function chooseDances(Music $music);
}
