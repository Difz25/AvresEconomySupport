<?php

namespace Difz25\AvresEconomySupport\Manager\Money;

use Difz25\AvresEconomySupport\AvresEconomySupport;
use Difz25\AvresEconomySupport\Manager\Manager;

use JsonException;
use pocketmine\player\Player;
use pocketmine\utils\Config;

class MoneyManager implements Manager{
    
    protected AvresEconomySupport $plugin;
    protected array $moneyData = [];
    private Config $config;

    public function __construct(AvresEconomySupport $plugin){
        $this->plugin = $plugin;
    }
    
    public function open(): void {
        $this->config = new Config($this->plugin->getDataFolder() . "Money.yml", Config::YAML, ["version" => 1, "money" => []]);
		$this->moneyData = $this->config->getAll();
    }
    
    public function getMoney(string|Player $player): float|bool {
		$player = $player->getName();
        $player = strtolower($player);

        if(isset($this->moneyData["money"][$player])){
            return $this->moneyData["money"][$player];
        }
        
        return false;
    }
    
    public function setMoney($player, $amount): bool
    {
		$player = $player->getName();
		$player = strtolower($player);

		if(isset($this->money["money"][$player])){
			$this->money["money"][$player] = $amount;
			$this->money["money"][$player] = round($this->money["money"][$player], 2);
			return true;
		}
		return false;
    }
    
    public function reduceMoney($player, $amount): bool
    {
        if($player instanceof Player){
            $player = $player->getName();
        }
        $player = strtolower($player);

        if(isset($this->money["money"][$player])){
            $this->money["money"][$player] -= $amount;
            $this->money["money"][$player] = round($this->money["money"][$player], 2);
            return true;
        }
        return false;
    }
    
    public function addMoney($player, $amount): bool
    {
		$player = $player->getName();
		$player = strtolower($player);

		if(isset($this->money["money"][$player])){
            $this->money["money"][$player] += $amount;
            $this->money["money"][$player] = round($this->money["money"][$player], 2);
            return true;
        }
        return false;
    }

    /**
     * @throws JsonException
     */
    public function save(): void {
		$this->config->setAll($this->moneyData);
	    $this->config->save();
	}

    /**
     * @throws JsonException
     */
    public function close(): void {
		$this->save();
	}

    /**
     * @return array
     */
    public function getAll(): array {
        return $this->moneyData["money"] ?? [];
    }
}