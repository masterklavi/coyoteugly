<?php

/**
 * @link https://github.com/masterklavi/coyoteugly/
 * @license http://opensource.org/licenses/MIT MIT License
 */

namespace coyoteugly\interfaces;

/**
 * Interface of MusicPlayer
 * 
 * @author <masterklavi@gmail.com>
 */
interface MusicPlayer
{
    /**
     * Loads music tracks from file
     * @param string $filename
     */
    public function loadTracklist(string $filename);
    
    /**
     * Plays music
     */
    public function play();
    
    /**
     * Changes music to the next
     */
    public function change();
    
    /**
     * Returns current music track
     */
    public function getTrack();
    
    /**
     * Returns current time shift
     * @return string
     */
    public function getTimeshift() : string;
}
