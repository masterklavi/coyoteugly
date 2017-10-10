<?php

/**
 * @link https://github.com/masterklavi/coyoteugly/
 * @license http://opensource.org/licenses/MIT MIT License
 */

namespace coyoteugly\club;

/**
 * Dance
 * 
 * @author <masterklavi@gmail.com>
 */
class Dance implements \coyoteugly\interfaces\Dance
{
    /**
     * Name of the dance
     * @var string
     */
    protected $name;
    
    /**
     * Genre of the dance
     * @var string
     */
    protected $genre;
    
    /**
     * Dance Motions
     * @var array 
     */
    protected $dance;
    
    /**
     * {@inheritDoc}
     */
    public function __construct(string $name, string $genre, array $dance)
    {
        $this->name = $name;
        $this->genre = $genre;
        $this->dance = $dance;
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
    public function getDance() : array
    {
        return $this->dance;
    }

    /**
     * {@inheritDoc}
     */
    public function dance(array $state) : array
    {
        foreach ($this->getDance() as $part => $values)
        {
            $state[$part] = $values[array_rand($values)];
        }
        
        return $state;
    }
}
