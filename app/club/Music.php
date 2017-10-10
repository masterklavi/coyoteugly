<?php

/**
 * @link https://github.com/masterklavi/coyoteugly/
 * @license http://opensource.org/licenses/MIT MIT License
 */

namespace coyoteugly\club;

/**
 * Music
 * 
 * @author <masterklavi@gmail.com>
 */
class Music implements \coyoteugly\interfaces\Music
{
    /**
     * Name of the music
     * @var string
     */
    protected $name;
    
    /**
     * Genre of the music
     * @var string
     */
    protected $genre;
    
    /**
     * Duration of the music
     * @var int
     */
    protected $duration;
    
    /**
     * {@inheritDoc}
     */
    public function __construct(string $name, string $genre, int $duration)
    {
        $this->name = $name;
        $this->genre = $genre;
        $this->duration = $duration;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function getGenre() : string
    {
        return $this->genre;
    }

    /**
     * {@inheritDoc}
     */
    public function getDuration() : int
    {
        return $this->duration;
    }
}
