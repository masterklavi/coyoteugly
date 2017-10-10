<?php

/**
 * @link https://github.com/masterklavi/coyoteugly/
 * @license http://opensource.org/licenses/MIT MIT License
 */

/**
 * Coyote Ugly Club
 * 
 * \ o     0  
 *   | \   |-'
 *  | \    П\ 
 * 
 * @author <masterklavi@gmail.com>
 */

PHP_OS === 'Linux' OR exit('Only Linux supported!'.PHP_EOL);
phpversion() >= 7 OR exit('Required php >= 7.0!'.PHP_EOL);

require __DIR__.'/app/autoload.php';
use coyoteugly\EventManager;

// Подготовка клуба "Гадкий Койот"

$club = new coyoteugly\club\CoyoteUgly();

$danceFloor = new coyoteugly\club\DanceFloor();
$danceFloor->loadDances(__DIR__.'/data/dances.json');
$club->setDanceFloor($danceFloor);

$player = new coyoteugly\club\DjPlayer();
$player->loadTracklist(__DIR__.'/data/tracklist.json');
$club->setPlayer($player);

EventManager::addListener('player_change_music', $danceFloor);


// Запускаем людей

$visitors = json_decode(file_get_contents(__DIR__.'/data/visitors.json'), true);
foreach ($visitors as $item)
{
    if ($item['gender'] === 'man')
    {
        $human = new coyoteugly\person\Man($item['name']);
    }
    else
    {
        $human = new coyoteugly\person\Woman($item['name']);
    }
    
    $human->setCanDance($item['canDance']);
    $club->addVisitor($human);
    
    EventManager::addListener('dancefloor_change_dances', $human);
}

// Открытие клуба
$club->showWelcome();

// В клубе начинается "движуха"
while (true)
{
    // проигрываем музыку
    $club->getPlayer()->play();
    
    // покажи нам, что там творится?
    $club->show();
    
    usleep(400000);
}
