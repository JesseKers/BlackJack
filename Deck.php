<?php

class Deck
{
    private array $cards;
    private array $ArrSuit = ["klaveren", "schoppen", "harten", "ruiten"];
    private array $ArrValue = ["2", "3", "4", "5", "6", "7", "8", "9", "10", "Boer", "Vrouw", "Heer", "Aas"];
    public function __construct()
    {
        $this->makeDeck();
    }
    public function drawCard() 
    {
        if (!count($this->cards)) {
            throw new Exception("Deck is empty");
        }
        return array_shift($this->cards);
    }
    private function makeDeck()
    {
        foreach ($this->ArrSuit as $suit) {
            foreach ($this->ArrValue as $value) {
                $this->cards[] = new Card($suit, $value);
            }
        }
        shuffle($this->cards);
    }
}
?>