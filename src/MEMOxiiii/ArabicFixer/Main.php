<?php
namespace MEMOxiiii\ArabicFixer;

use pocketmine\plugin\PluginBase;

class Main extends PluginBase {
    private ArabicTextCorrector $corrector;
    private ChatHandler $chatHandler;
    private SignHandler $signHandler;

    public function onEnable(): void {
        $this->corrector = new ArabicTextCorrector();
        $this->chatHandler = new ChatHandler($this->corrector);
        $this->signHandler = new SignHandler($this->corrector);

        $this->getServer()->getPluginManager()->registerEvents($this->chatHandler, $this);
        $this->getServer()->getPluginManager()->registerEvents($this->signHandler, $this);
    }

    public function onDisable(): void {
    }
}
