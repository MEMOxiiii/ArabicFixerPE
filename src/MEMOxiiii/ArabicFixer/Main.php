<?php
namespace MEMOxiiii\ArabicFixer;

use pocketmine\plugin\PluginBase;

    /**
     * author: MEMOxiiii
     */

class Main extends PluginBase {
    private ArabicTextCorrector $corrector;
    private ChatHandler $chatHandler;
    private SignHandler $signHandler;

    public function onEnable(): void {
        $this->saveDefaultConfig();

        $this->corrector = new ArabicTextCorrector();
        $this->chatHandler = new ChatHandler(
            $this->corrector,
            (bool) $this->getConfig()->get("chat-enabled", true)
        );
        $this->signHandler = new SignHandler(
            $this->corrector,
            (bool) $this->getConfig()->get("sign-enabled", true)
        );

        $this->getServer()->getPluginManager()->registerEvents($this->chatHandler, $this);
        $this->getServer()->getPluginManager()->registerEvents($this->signHandler, $this);

        $this->logDetectedIntegrations();
    }

    public function onDisable(): void {
    }

    private function logDetectedIntegrations(): void {
        $pluginManager = $this->getServer()->getPluginManager();
        $supported = ["RankSystem", "ChatPerms", "PurePerms", "LuckPerms"];
        $detected = [];

        foreach ($supported as $pluginName) {
            $plugin = $pluginManager->getPlugin($pluginName);
            if ($plugin !== null && $plugin->isEnabled()) {
                $detected[] = $pluginName;
            }
        }

        if ($detected !== []) {
            $this->getLogger()->info("Detected chat/rank plugins: " . implode(", ", $detected));
        } else {
            $this->getLogger()->info("No known chat/rank plugin detected. ArabicFixer will still work with default chat.");
        }
    }
}