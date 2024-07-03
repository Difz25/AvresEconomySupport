<?php

namespace Difz25\AvresEconomySupport;

use JsonException;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use Difz25\AvresEconomySupport\Manager\Money\MoneyManager;
use pocketmine\utils\Config;

class AvresEconomySupport extends PluginBase {

    protected MoneyManager $moneymgr;
    protected Config $config;

    /**
     * @throws JsonException
     */
    public function onEnable(): void {
        $this->moneymgr = new MoneyManager($this);
        $this->config = new Config($this->getDataFolder() . "money.yml", Config::YAML, ["version" => 2, "money" => []]);
        $this->moneymgr->save();
    }
     protected function onDisable(): void {
         $this->moneymgr->close();
     }

    public function getAllMoney(): array
    {
        return $this->moneymgr->getAll();
    }
    
    public function getMoney($player){
        return $this->moneymgr->getMoney($player);
    }
    
    public function setMoney($player, $amount): bool
    {
        return $this->moneymgr->setMoney($player, $amount);
    }
    
    public function reduceMoney($player, $amount): bool
    {
        return $this->moneymgr->reduceMoney($player, $amount);
    }
    
    public function addMoney($player, $amount): bool
    {
        return $this->moneymgr->addMoney($player, $amount);
    }
    
    public function getMoneyData(): Config {
        return $this->config;
    }
    
    public function getConfigData(): Config {
        return $this->config;
    }
    
    public function isPlayer($player): void {
        if($player instanceof Player);
    }
}