<?php

/**
 * @link https://github.com/masterklavi/coyoteugly/
 * @license http://opensource.org/licenses/MIT MIT License
 */

namespace coyoteugly\person;

use coyoteugly\interfaces\Visitor;
use coyoteugly\interfaces\EventListener;

/**
 * Person
 * 
 * @author <masterklavi@gmail.com>
 */
abstract class Person implements \coyoteugly\interfaces\Human, Visitor, EventListener
{
    /**
     * Does Person have a long face?
     * @var mixed
     */
    protected $longFace = null;
    
    /**
     * Name
     * @var string
     */
    protected $name;
    
    /**
     * Array of dances visitor can dance
     * @var array
     */
    protected $canDance;
    
    /**
     * Current placement
     * @var array
     */
    protected $currentPlace;
    
    /**
     * Current Dance
     * @var \coyoteugly\interfaces\Dance
     */
    protected $currentDance;
    
    /**
     * Current State (placement of body parts)
     * @var array 
     */
    protected $currentState = [
        'head' => 'left',
        'left-hand' => 'up',
        'right-hand' => 'down',
        'left-foot' => 'in',
        'right-foot' => 'out',
    ];
    
    /**
     * {@inheritDoc}
     */
    public function __construct(string $name)
    {
        $this->name = $name;
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
    public function getCanDance() : array
    {
        return $this->canDance;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setCanDance(array $canDance)
    {
        $this->canDance = $canDance;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getPlace() : int
    {
        return $this->currentPlace;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setPlace(int $place)
    {
        $this->currentPlace = $place;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getDance()
    {
        return $this->currentDance;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setDance($dance)
    {
        $this->currentDance = $dance;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getState() : array
    {
        return $this->currentState;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setState(array $state)
    {
        $this->currentState = $state;
    }
    
    /**
     * Changes visitor's placement and dance on dance change
     * @param string $event_name
     * @param array $dances
     */
    public function trigger(string $event_name, $dances = null)
    {
        if ($event_name !== 'dancefloor_change_dances')
        {
            return;
        }
        
        if ($this->chooseDance($dances) === null)
        {
            $this->setPlace(Visitor::PLACE_BAR);
        }
        else
        {
            $this->setPlace(Visitor::PLACE_DANCEFLOOR);
        }
    }
    
    /**
     * Choose preferred dance
     * @param array $dances
     * @return mixed
     */
    protected function chooseDance(array $dances)
    {
        $selected = null;
        foreach ($this->getCanDance() as $name)
        {
            foreach ($dances as $dance)
            {
                if ($dance->getName() === $name)
                {
                    $selected = $dance;
                    break 2;
                }
            }
        }
        
        $this->setDance($selected);
        
        return $selected;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getView()
    {
        if ($this->getPlace() === Visitor::PLACE_DANCEFLOOR)
        {
            return $this->getDancingView();
        }
        else
        {
            return $this->getDrinkingView();
        }
    }
    
    /**
     * Returns view in Dancing State
     * @return array
     */
    protected function getDancingView() : array
    {
        $head = $this->longFace ? '0' : 'o';
        $state = $this->getState();

        // построчная отрисовка
        $rows[0] =    ($state['left-hand'] === 'up' ? '\\' : ' ')
                    . ($state['head'] === 'left' ? $head : ' ')
                    . ($state['head'] === 'center' ? $head : ' ')
                    . ($state['head'] === 'right' ? $head : ' ')
                    . ($state['right-hand'] === 'up' ? '/' : ' ');

        $rows[1] =    ($state['left-hand'] === 'down' ? '/' : ' ')
                    . ' | '
                    . ($state['right-hand'] === 'down' ? '\\' : ' ');

        $rows[2] =    ' '
                    . ($state['left-foot'] === 'in' ? '|' : '/')
                    . ' '
                    . ($state['right-foot'] === 'in' ? '|' : '\\')
                    . ' ';

        $rows[3] = sprintf('%-5s', substr($this->getName(), 0, 5));
        $rows[4] = sprintf('%-5s', substr($this->getDance()->getName(), 0, 5));
        
        return $rows;
    }
    
    /**
     * Returns view in Drinking State
     * @return array
     */
    protected function getDrinkingView() : array
    {
        $head = $this->longFace ? '0' : 'o';
        
        if (rand(0, 4) == 0)
        {
            $rows[0] = ' '.$head.'   ';
            $rows[1] = ' |-\' ';
            $rows[2] = ' П\\  ';
        }
        else
        {
            $rows[0] = ' '.$head.'.  ';
            $rows[1] = ' |   ';
            $rows[2] = ' П\\  ';
        }

        $rows[3] = sprintf('%-5s', substr($this->getName(), 0, 5));
        $rows[4] = 'vodka';
        
        return $rows;
    }
}
