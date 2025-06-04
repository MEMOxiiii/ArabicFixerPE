<?php
namespace MEMOxiiii\ArabicFixer;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;

class Main extends PluginBase implements Listener {
    public function onEnable(): void {
        $this->getServer()->getPluginManager()->registerEvents(new ChatHandler(), $this);
    }

    public function onDisable(): void {
    }
}