<?php

/**
 * @link https://github.com/masterklavi/coyoteugly/
 * @license http://opensource.org/licenses/MIT MIT License
 */

namespace coyoteugly\interfaces;

/**
 * Interface of Club
 * 
 * @author <masterklavi@gmail.com>
 */
interface Club
{
    /**
     * Adds a visitor to the club
     * @param \coyoteugly\interfaces\Visitor $visitor
     */
    public function addVisitor(Visitor $visitor);
    
    /**
     * Returns installed player
     * @return \coyoteugly\interfaces\MusicPlayer
     */
    public function getPlayer() : MusicPlayer;
    
    /**
     * Installs a player to the club
     * @param \coyoteugly\interfaces\MusicPlayer $player
     */
    public function setPlayer(MusicPlayer $player);
    
    /**
     * Returns installed dance floor
     * @return \coyoteugly\interfaces\DanceFloor
     */
    public function getDanceFloor() : DanceFloor;
    
    /**
     * Installs a dance floor to the club
     * @param \coyoteugly\interfaces\DanceFloor $danceFloor
     */
    public function setDanceFloor(DanceFloor $danceFloor);
    
    /**
     * Shows welcome message
     */
    public function showWelcome();
    
    /**
     * Shows situation in the club
     */
    public function show();
}
