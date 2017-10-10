<?php

/**
 * @link https://github.com/masterklavi/coyoteugly/
 * @license http://opensource.org/licenses/MIT MIT License
 */

namespace coyoteugly\club;

use coyoteugly\interfaces\MusicPlayer;
use coyoteugly\EventManager;

/**
 * DJ Player
 * 
 * @author <masterklavi@gmail.com>
 */
class DjPlayer implements MusicPlayer
{
    /**
     * Array of music tracks
     * @var array
     */
    protected $tracklist = [];
    
    /**
     * Current Track No
     * @var mixed
     */
    protected $currentTrackNo = null;
    
    /**
     * Current Track Timestamp
     * @var mixed
     */
    protected $currentTrackTimestamp = null;
    
    /**
     * {@inheritDoc}
     */
    public function loadTracklist(string $filename)
    {
        $items = json_decode(file_get_contents($filename), true);
        foreach ($items as $item)
        {
            $this->tracklist[] = new Music($item['name'], $item['genre'], $item['duration']);
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function getTrack()
    {
        if ($this->currentTrackNo === null)
        {
            return null;
        }
        
        return $this->tracklist[$this->currentTrackNo];
    }
    
    /**
     * {@inheritDoc}
     */
    public function getTimeshift() : string
    {
        if ($this->currentTrackTimestamp === null)
        {
            return '??:??';
        }
        
        $shift = (time() - $this->currentTrackTimestamp);
        return sprintf('%02d:%02d', floor($shift/60), $shift%60);
    }
    
    /**
     * {@inheritDoc}
     */
    public function play()
    {
        // что там сейчас играет?
        $music = $this->getTrack();
        
        if ($music === null)
        {
            // ничего не играет!? так поставьте же!
            $this->change();
            $music = $this->getTrack();
        }
        
        if (time() > $music->getDuration() + $this->currentTrackTimestamp)
        {
            // эта пластинка закончилась, поставьте другую!
            $this->change();
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function change()
    {
        if ($this->currentTrackNo === null)
        {
            $this->currentTrackNo = 0;
        }
        else
        {
            $this->currentTrackNo++;
            
            if ($this->currentTrackNo >= count($this->tracklist))
            {
                $this->currentTrackNo = 0;
            }
        }
        
        $this->currentTrackTimestamp = time();
        EventManager::trigger('player_change_music', $this->getTrack());
    }
}
