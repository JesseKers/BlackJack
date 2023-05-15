<?php

class BlackJack
{
    private int $score;
    public function scoreHand(array $hand): string
    {
        $this->score = 0;
        foreach ($hand as $card) {
            if (preg_match("/[0-9]|B|V|H|A/", $card, $match)) {
                $card = new Card("", $match[0]);
                $this->score += $card->score();
            }
        }
        if (count($hand) >= 2) {
            if ($this->score == 21 && count($hand) == 2) {
                return "Blackjack";
            } else if ($this->score > 21) {
                return 'Busted';
            } else if ($this->score == 21) {
                	return "Twenty-One";
            } else if (count($hand) == 5) {
                return "Five card Charlie";
            }
        }
        return $this->score;
    }
}