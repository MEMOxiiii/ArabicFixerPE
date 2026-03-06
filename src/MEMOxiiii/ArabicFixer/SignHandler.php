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
    private bool $enabled;

    public function __construct(ArabicTextCorrector $corrector, bool $enabled = true) {
        $this->corrector = $corrector;
        $this->enabled = $enabled;
    }

    public function onSignChange(SignChangeEvent $event): void {
        if (!$this->enabled) {
            return;
        }

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