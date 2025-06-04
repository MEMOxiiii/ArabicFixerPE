<?php
namespace MEMOxiiii\ArabicFixer;

class Rule {
    public string $regex;
    public string $replacerchar;

    public function __construct(string $patt, string $replacer) {
        $this->regex = $patt;
        $this->replacerchar = $replacer;
    }
}