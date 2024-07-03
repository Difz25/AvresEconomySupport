<?php

/*
* EconomyS, the massive economy plugin with many features for PocketMine-MP
* Copyright (C) 2013-2017  onebone <jyc00410@gmail.com>
*
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

namespace Difz25\AvresEconomySupport\Manager;

use Difz25\AvresEconomySupport\AvresEconomySupport;
use pocketmine\player\Player;

interface Manager{
    public function __construct(AvresEconomySupport $plugin);

    public function open();

    /**
    * @param string $player
    * @return float|bool
    */
    public function getMoney(string $player): float|bool;

    /**
    * @param string|Player $player
    * @param float $amount
    * @return bool
    */
    public function setMoney(Player|string $player, float $amount): bool;

    /**
    * @param string|Player $player
    * @param float $amount
    * @return bool
    */
    public function addMoney(Player|string $player, float $amount): bool;

    /**
    * @param string|Player $player
    * @param float $amount
    * @return bool
    */
    public function reduceMoney(Player|string $player, float $amount): bool;

    /**
    * @return array
    */
    public function getAll(): array;
    
    public function save();
    public function close();
}
