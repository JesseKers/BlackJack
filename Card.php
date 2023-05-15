<?php

class Card
{
    private string $suit;
    private string $value;
    public int $score;
    public function __construct(string $suit, string $value)
    {
        $this->validateSuit($suit);
        $this->validateValue($value);
        $this->suit = $suit;
        $this->value = $value;
    }
    public function show(): string
    {
        switch ($this->suit) {
            case "klaveren":
                $this->suit = "♣";
                break;
            case "schoppen":
                $this->suit = "♠";
                break;
            case "harten":
                $this->suit = "♥";
                break;
            case "ruiten":
                $this->suit = "♦";
                break;
        }
        switch ($this->value) {
            case "Boer":
                $this->value = "B";
                break;
            case "Vrouw":
                $this->value = "V";
                break;
            case "Heer":
                $this->value = "H";
                break;
            case "Aas":
                $this->value = "A";
                break;
        }
        return $this->suit . $this->value;
    }
    public function score(): int
    {
        if ($this->value == "A") {
            $this->score = + 11;
        } elseif ($this->value == "1" || $this->value == "B" || $this->value == "V" || $this->value == "H") {
            $this->score = + 10;
        } else {
            $this->score = + $this->value;
        }
        return $this->score;
    }
    private function validateSuit($suit)
    {
        $ArrSuit = ["klaveren", "schoppen", "harten", "ruiten", ""];
        try {
            if (in_array($suit, $ArrSuit)) {
                return true;
            } else {
                throw new InvalidArgumentException("Invalid suit given: " . $suit);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
    private function validateValue($value)
    {
        $ArrValue = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "Boer", "Vrouw", "Heer", "Aas", "B", "V", "H", "A" ];
        try {
            if (in_array($value, $ArrValue)) {
                return true;
            } else {
                throw new InvalidArgumentException("Invalid value given: " . $value);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
}

