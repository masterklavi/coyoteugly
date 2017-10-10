<?php

/**
 * @link https://github.com/masterklavi/coyoteugly/
 * @license http://opensource.org/licenses/MIT MIT License
 */

namespace coyoteugly\club;

use coyoteugly\interfaces\Music;
use coyoteugly\interfaces\EventListener;
use coyoteugly\EventManager;

/**
 * DanceFloor
 * 
 * @author <masterklavi@gmail.com>
 */
class DanceFloor implements \coyoteugly\interfaces\DanceFloor, EventListener
{
    /**
     * All loaded Dances
     * @var array
     */
    protected $dances = [];
    
    /**
     * {@inheritDoc}
     */
    public function loadDances(string $filename)
    {
        $items = json_decode(file_get_contents($filename), true);
        foreach ($items as $item)
        {
            $this->dances[] = new Dance($item['name'], $item['genre'], $item['dance']);
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function chooseDances(Music $music)
    {
        $dances = [];
        foreach ($this->dances as $dance)
        {
            if ($dance->getGenre() === $music->getGenre())
            {
                $dances[] = $dance;
            }
        }
        return $dances;
    }

    /**
     * Changes dance on music change
     * @param string $event_name
     * @param \coyoteugly\interfaces\Music $music
     */
    public function trigger(string $event_name, $music = null)
    {
        if ($event_name !== 'player_change_music')
        {
            return;
        }
        
        EventManager::trigger('dancefloor_change_dances', $this->chooseDances($music));
    }
}
