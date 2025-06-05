<?php
namespace MEMOxiiii\ArabicFixer;

    /**
     * author: MEMOxiiii
     */

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\Server;

class ChatHandler implements Listener {
    private ArabicTextCorrector $corrector;

    public function __construct(ArabicTextCorrector $corrector) {
        $this->corrector = $corrector;
    }

    public function onChat(PlayerChatEvent $event): void {
        $player = $event->getPlayer();
        $originalMessage = $event->getMessage();

        Server::getInstance()->getLogger()->info("<{$player->getName()}> {$originalMessage}");

        $correctedMessage = $this->corrector->correctArabicText($originalMessage);

        $event->setMessage($correctedMessage);

        $recipients = $event->getRecipients();
        $event->setRecipients([]);

        foreach ($recipients as $recipient) {
            if ($recipient instanceof \pocketmine\player\Player) {
                $recipient->sendMessage("<{$player->getName()}> {$correctedMessage}");
            }
        }
    }
}
