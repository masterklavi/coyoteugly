<?php

/**
 * @link https://github.com/masterklavi/coyoteugly/
 * @license http://opensource.org/licenses/MIT MIT License
 */

namespace coyoteugly\club;

use coyoteugly\interfaces\Club;
use coyoteugly\interfaces\Visitor;
use coyoteugly\interfaces\MusicPlayer;
use coyoteugly\interfaces\DanceFloor;

/**
 * Coyote Ugly Club
 * 
 * @author <masterklavi@gmail.com>
 */
class CoyoteUgly implements Club
{
    /**
     * Club Visitors
     * @var array
     */
    protected $visitors = [];
    
    /**
     * Installed Music Player
     * @var \coyoteugly\interfaces\MusicPlayer
     */
    protected $player = null;
    
    /**
     * Installed Dance Floor
     * @var \coyoteugly\interfaces\DanceFloor 
     */
    protected $danceFloor = null;
    
    /**
     * {@inheritDoc}
     */
    public function addVisitor(Visitor $visitor)
    {
        $this->visitors[] = $visitor;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getPlayer() : MusicPlayer
    {
        return $this->player;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setPlayer(MusicPlayer $player)
    {
        $this->player = $player;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getDanceFloor() : DanceFloor
    {
        return $this->danceFloor;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setDanceFloor(DanceFloor $danceFloor)
    {
        $this->danceFloor = $danceFloor;
    }
    
    /**
     * {@inheritDoc}
     */
    public function showWelcome()
    {
        $this->showText(PHP_EOL.'*** Welcome to CoyoteUgly! ***'.PHP_EOL);
    }
    
    /**
     * {@inheritDoc}
     */
    public function show()
    {
        $rows = ['', '', '', '', ''];
        
        // что сейчас играет?
        $this->showNowPlaying();
        
        // посмотрим на тех, кто в баре
        $this->drawBar($rows);
        
        // посмотрим на тех, кто на танцполе
        $this->drawDanceFloor($rows);
        
        // выведем всё это представление в терминал
        
        if (strlen($rows[0]) > `tput cols`)
        {
            print chr(27) . "[0G";
            $this->showText('%Screen width% is too small!'.PHP_EOL.PHP_EOL.PHP_EOL.PHP_EOL);
            print chr(27) . "[7A";
            return;
        }
        
        print chr(27) . "[0G";
        $this->showText(implode(PHP_EOL, $rows));
        print chr(27) . "[7A";
    }
    
    /**
     * Prints text to console with overwriting
     * @param string $text
     */
    protected function showText(string $text)
    {
        $cols = (int)`tput cols`;
        foreach (explode(PHP_EOL, $text) as $line)
        {
            if (strlen($line) < $cols)
            {
                print $line.str_repeat(' ', $cols - strlen($line)).PHP_EOL;
            }
            else
            {
                print substr($line, 0, $cols).PHP_EOL;
            }
        }
    }
    
    /**
     * Prints "Now Playing"
     */
    protected function showNowPlaying()
    {
        $pattern = "Now playing: %s [%s / %02d:%02d]".PHP_EOL;
        
        $player = $this->getPlayer();
        $music = $player->getTrack();
        $duration = $music->getDuration();
        
        $text = sprintf($pattern, $music->getName(), $player->getTimeshift(), floor($duration / 60), $duration % 60);
        $this->showText($text);
    }
    
    /**
     * Draws Bar to the view array
     * @param array $rows
     */
    protected function drawBar(array &$rows)
    {
        foreach ($this->visitors as $visitor)
        {
            if ($visitor->getPlace() !== Visitor::PLACE_BAR)
            {
                continue;
            }
            
            $view = $visitor->getView();
            for ($i = 0; $i < 5; $i++)
            {
                $rows[$i] .= $view[$i].'  ';
            }
        }
        
        // заполним оставшееся место и нарисуем перегородку
        $spaces = str_repeat(' ', 7*7-strlen($rows[0]));
        for ($i = 0; $i < 5; $i++)
        {
            $rows[$i] .= $spaces.'*  ';
        }
    }
    
    /**
     * Draws Dance Floor to the view array
     * @param array $rows
     */
    protected function drawDanceFloor(array &$rows)
    {
        foreach ($this->visitors as $visitor)
        {
            if ($visitor->getPlace() !== Visitor::PLACE_DANCEFLOOR)
            {
                continue;
            }
            
            $visitor->setState($visitor->getDance()->dance($visitor->getState()));
            $view = $visitor->getView();
            for ($i = 0; $i < 5; $i++)
            {
                $rows[$i] .= $view[$i].'  ';
            }
        }
    }
}
