<?php
namespace MEMOxiiii\ArabicFixer;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;

    /**
     * author: MEMOxiiii
     */

class ChatHandler implements Listener {
    private ArabicTextCorrector $corrector;
    private bool $enabled;

    public function __construct(ArabicTextCorrector $corrector, bool $enabled = true) {
        $this->corrector = $corrector;
        $this->enabled = $enabled;
    }

    public function onChat(PlayerChatEvent $event): void {
        if (!$this->enabled) {
            return;
        }

        $originalMessage = $event->getMessage();
        $correctedMessage = $this->corrector->correctArabicText($originalMessage);

        if ($correctedMessage === $originalMessage) {
            return;
        }

        $event->setMessage($correctedMessage);
    }
}