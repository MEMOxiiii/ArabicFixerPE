<?php
namespace MEMOxiiii\ArabicFixer;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;

class ChatHandler implements Listener {
    /** @var Rule[] */
    private array $rules = [];

    public function __construct() {
        $nonJoinerLetters = "ﺬآداﺇﺁﺃﺎﺈﺂﺄرﺮزﺰژﮋذﺲﺶﺺﺾوﭗﺚﺖﺞﭻﺢﺦﺐﻂﻆﻊﻎﻒﻖﮏﮓﻚﻞﻢﻦﻮﻪﻰﺊﻲﺪﻼﻻﻺﻹﻶﻵﻸﻷﷺﷲﺔﻪﺅ";
        $nospaceAfter = "(?!\s|$|^)";
        $spaceAfter = "(?=\s|^|$)";
        $nonJoinerRegex = "(?<!\s|^|$|[" . $nonJoinerLetters . "])";
        $isnonJoinerRegex = "(?<=\\s|^|$|[" . $nonJoinerLetters . "])";
        $joinerRegex = "(?<!\s\w[^" . $nonJoinerLetters . "])";

        $this->rules[] = new Rule($spaceAfter . "الله", "ﷲ");
        $this->rules[] = new Rule($spaceAfter . "الله" . $spaceAfter, "ﷲ");
        $this->rules[] = new Rule($spaceAfter . "صلى", "ﷺ");
        $this->rules[] = new Rule("لإ", "ﻹ");
        $this->rules[] = new Rule($joinerRegex . "ﻹ", "ﻺ");
        $this->rules[] = new Rule("لآ", "ﻵ");
        $this->rules[] = new Rule($joinerRegex . "ﻵ", "ﻶ");
        $this->rules[] = new Rule("لأ", "ﻷ");
        $this->rules[] = new Rule($joinerRegex . "ﻷ", "ﻸ");
        $this->rules[] = new Rule("لا", "ﻻ");
        $this->rules[] = new Rule($joinerRegex . "ﻼ" . $spaceAfter, "ﻼ");
        $this->rules[] = new Rule($nonJoinerRegex . "ا", "ﺎ");
        $this->rules[] = new Rule($nonJoinerRegex . "ب" . $nospaceAfter, "ﺒ");
        $this->rules[] = new Rule($joinerRegex . "ب" . $nospaceAfter, "ﺑ");
        $this->rules[] = new Rule($nonJoinerRegex . "ب" . $spaceAfter, "ﺐ");
        $this->rules[] = new Rule($nonJoinerRegex . "پ" . $nospaceAfter, "ﭙ");
        $this->rules[] = new Rule($joinerRegex . "پ" . $nospaceAfter, "ﭘ");
        $this->rules[] = new Rule($nonJoinerRegex . "پ" . $spaceAfter, "ﭗ");
        $this->rules[] = new Rule($nonJoinerRegex . "ت" . $nospaceAfter, "ﺘ");
        $this->rules[] = new Rule($joinerRegex . "ت" . $nospaceAfter, "ﺗ");
        $this->rules[] = new Rule($nonJoinerRegex . "ت" . $spaceAfter, "ﺖ");
        $this->rules[] = new Rule($nonJoinerRegex . "ث" . $nospaceAfter, "ﺜ");
        $this->rules[] = new Rule($joinerRegex . "ث" . $nospaceAfter, "ﺛ");
        $this->rules[] = new Rule($nonJoinerRegex . "ث" . $spaceAfter, "ﺚ");
        $this->rules[] = new Rule($nonJoinerRegex . "ج" . $nospaceAfter, "ﺠ");
        $this->rules[] = new Rule($joinerRegex . "ج" . $nospaceAfter, "ﺟ");
        $this->rules[] = new Rule($nonJoinerRegex . "ج" . $spaceAfter, "ﺞ");
        $this->rules[] = new Rule($nonJoinerRegex . "چ" . $nospaceAfter, "ﭽ");
        $this->rules[] = new Rule($joinerRegex . "چ" . $nospaceAfter, "ﭼ");
        $this->rules[] = new Rule($nonJoinerRegex . "چ" . $spaceAfter, "ﭻ");
        $this->rules[] = new Rule($nonJoinerRegex . "ح" . $nospaceAfter, "ﺤ");
        $this->rules[] = new Rule($joinerRegex . "ح" . $nospaceAfter, "ﺣ");
        $this->rules[] = new Rule($nonJoinerRegex . "ح" . $spaceAfter, "ﺢ");
        $this->rules[] = new Rule($nonJoinerRegex . "خ" . $nospaceAfter, "ﺨ");
        $this->rules[] = new Rule($joinerRegex . "خ" . $nospaceAfter, "ﺧ");
        $this->rules[] = new Rule($joinerRegex . "خ" . $spaceAfter, "ﺦ");
        $this->rules[] = new Rule($joinerRegex . "د" . $spaceAfter, "ﺪ");
        $this->rules[] = new Rule($joinerRegex . "ذ" . $spaceAfter, "ﺬ");
        $this->rules[] = new Rule($joinerRegex . "ر" . $spaceAfter, "ﺮ");
        $this->rules[] = new Rule($joinerRegex . "ز" . $spaceAfter, "ﺰ");
        $this->rules[] = new Rule($joinerRegex . "ژ" . $spaceAfter, "ﮋ");
        $this->rules[] = new Rule($nonJoinerRegex . "س" . $nospaceAfter, "ﺴ");
        $this->rules[] = new Rule($joinerRegex . "س" . $nospaceAfter, "ﺳ");
        $this->rules[] = new Rule($nonJoinerRegex . "س" . $spaceAfter, "ﺲ");
        $this->rules[] = new Rule($nonJoinerRegex . "ش" . $nospaceAfter, "ﺸ");
        $this->rules[] = new Rule($joinerRegex . "ش" . $nospaceAfter, "ﺷ");
        $this->rules[] = new Rule($nonJoinerRegex . "ش" . $spaceAfter, "ﺶ");
        $this->rules[] = new Rule($nonJoinerRegex . "ص" . $nospaceAfter, "ﺼ");
        $this->rules[] = new Rule($joinerRegex . "ص" . $nospaceAfter, "ﺻ");
        $this->rules[] = new Rule($nonJoinerRegex . "ص" . $spaceAfter, "ﺺ");
        $this->rules[] = new Rule($nonJoinerRegex . "ض" . $nospaceAfter, "ﻀ");
        $this->rules[] = new Rule($joinerRegex . "ض" . $nospaceAfter, "ﺿ");
        $this->rules[] = new Rule($nonJoinerRegex . "ض" . $spaceAfter, "ﺾ");
        $this->rules[] = new Rule($nonJoinerRegex . "ط" . $nospaceAfter, "ﻄ");
        $this->rules[] = new Rule($joinerRegex . "ط" . $nospaceAfter, "ﻃ");
        $this->rules[] = new Rule($nonJoinerRegex . "ط" . $spaceAfter, "ﻂ");
        $this->rules[] = new Rule($nonJoinerRegex . "ظ" . $nospaceAfter, "ﻈ");
        $this->rules[] = new Rule($joinerRegex . "ظ" . $nospaceAfter, "ﻇ");
        $this->rules[] = new Rule($nonJoinerRegex . "ظ" . $spaceAfter, "ﻆ");
        $this->rules[] = new Rule($nonJoinerRegex . "ع" . $nospaceAfter, "ﻌ");
        $this->rules[] = new Rule($joinerRegex . "ع" . $nospaceAfter, "ﻋ");
        $this->rules[] = new Rule($nonJoinerRegex . "ع" . $spaceAfter, "ﻊ");
        $this->rules[] = new Rule($nonJoinerRegex . "غ" . $nospaceAfter, "ﻐ");
        $this->rules[] = new Rule($joinerRegex . "غ" . $nospaceAfter, "ﻏ");
        $this->rules[] = new Rule($nonJoinerRegex . "غ" . $spaceAfter, "ﻎ");
        $this->rules[] = new Rule($nonJoinerRegex . "ف" . $nospaceAfter, "ﻔ");
        $this->rules[] = new Rule($joinerRegex . "ف" . $nospaceAfter, "ﻓ");
        $this->rules[] = new Rule($nonJoinerRegex . "ف" . $spaceAfter, "ﻒ");
        $this->rules[] = new Rule($nonJoinerRegex . "ق" . $nospaceAfter, "ﻘ");
        $this->rules[] = new Rule($joinerRegex . "ق" . $nospaceAfter, "ﻗ");
        $this->rules[] = new Rule($nonJoinerRegex . "ق" . $spaceAfter, "ﻖ");
        $this->rules[] = new Rule($nonJoinerRegex . "ک" . $nospaceAfter, "ﮑ");
        $this->rules[] = new Rule($joinerRegex . "ک" . $nospaceAfter, "ﮐ");
        $this->rules[] = new Rule($nonJoinerRegex . "ک" . $spaceAfter, "ﮏ");
        $this->rules[] = new Rule($nonJoinerRegex . "ك" . $nospaceAfter, "ﻜ");
        $this->rules[] = new Rule($joinerRegex . "ك" . $nospaceAfter, "ﻛ");
        $this->rules[] = new Rule($nonJoinerRegex . "ك" . $spaceAfter, "ﻚ");
        $this->rules[] = new Rule($nonJoinerRegex . "گ" . $nospaceAfter, "ﮕ");
        $this->rules[] = new Rule($joinerRegex . "گ" . $nospaceAfter, "ﮔ");
        $this->rules[] = new Rule($nonJoinerRegex . "گ" . $spaceAfter, "ﮓ");
        $this->rules[] = new Rule($nonJoinerRegex . "ل" . $nospaceAfter, "ﻠ");
        $this->rules[] = new Rule($joinerRegex . "ل" . $nospaceAfter, "ﻟ");
        $this->rules[] = new Rule($nonJoinerRegex . "ل" . $spaceAfter, "ﻞ");
        $this->rules[] = new Rule($nonJoinerRegex . "م" . $nospaceAfter, "ﻤ");
        $this->rules[] = new Rule($joinerRegex . "م" . $nospaceAfter, "ﻣ");
        $this->rules[] = new Rule($nonJoinerRegex . "م" . $spaceAfter, "ﻢ");
        $this->rules[] = new Rule($nonJoinerRegex . "ن" . $nospaceAfter, "ﻨ");
        $this->rules[] = new Rule($joinerRegex . "ن" . $nospaceAfter, "ﻧ");
        $this->rules[] = new Rule($nonJoinerRegex . "ن" . $spaceAfter, "ﻦ");
        $this->rules[] = new Rule($nonJoinerRegex . "و" . $spaceAfter, "ﻮ");
        $this->rules[] = new Rule($nonJoinerRegex . "ه" . $nospaceAfter, "ﻬ");
        $this->rules[] = new Rule($joinerRegex . "ه" . $nospaceAfter, "ﻫ");
        $this->rules[] = new Rule($nonJoinerRegex . "ه" . $spaceAfter, "ﻪ");
        $this->rules[] = new Rule($isnonJoinerRegex . "ه" . $spaceAfter, "ﮦ");
        $this->rules[] = new Rule($nonJoinerRegex . "ی" . $nospaceAfter, "ﻴ");
        $this->rules[] = new Rule($joinerRegex . "ی" . $nospaceAfter, "ﻳ");
        $this->rules[] = new Rule($nonJoinerRegex . "ی" . $spaceAfter, "ﻰ");
        $this->rules[] = new Rule($nonJoinerRegex . "ي" . $nospaceAfter, "ﻴ");
        $this->rules[] = new Rule($joinerRegex . "ي" . $nospaceAfter, "ﻳ");
        $this->rules[] = new Rule($nonJoinerRegex . "ي" . $spaceAfter, "ﻲ");
        $this->rules[] = new Rule($nonJoinerRegex . "ي" . $nospaceAfter, "ﺌ");
        $this->rules[] = new Rule($joinerRegex . "ي" . $nospaceAfter, "ﺋ");
        $this->rules[] = new Rule($nonJoinerRegex . "ي" . $spaceAfter, "ﺊ");
    }

    public function onChat(PlayerChatEvent $event): void {
        $message = $event->getMessage();
        if (preg_match("/^[\x{0600}-\x{06FF}\x{FB8A}\x{067E}\x{0686}\x{06AF}\x{200C}\x{200F} ]+$/u", $message)) {
            foreach ($this->rules as $rule) {
                $message = preg_replace("/" . $rule->regex . "/u", $rule->replacerchar, $message);
            }

            $reversed = '';
            $messageArray = mb_str_split($message);
            for ($i = count($messageArray) - 1; $i >= 0; $i--) {
                $reversed .= $messageArray[$i];
            }
            $event->setMessage($reversed);
        }
    }
}