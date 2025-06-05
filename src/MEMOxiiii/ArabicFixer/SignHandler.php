<?php
namespace MEMOxiiii\ArabicFixer;

    /**
     * author: MEMOxiiii
     */

use pocketmine\event\Listener;
use pocketmine\event\block\SignChangeEvent;
use pocketmine\block\utils\SignText;

class SignHandler implements Listener {
    private ArabicTextCorrector $corrector;

    public function __construct(ArabicTextCorrector $corrector) {
        $this->corrector = $corrector;
    }

    public function onSignChange(SignChangeEvent $event): void {
        $signText = $event->getNewText();
        $lines = $signText->getLines();
        $correctedLines = [];
        foreach ($lines as $line) {
            $correctedLines[] = $this->corrector->correctArabicText($line);
        }
        $correctedLines = array_pad($correctedLines, 4, "");
        $event->setNewText(new SignText($correctedLines));
    }
}