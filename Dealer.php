<?php

class Dealer
{
    private BLackJack $blackJack;
    private Deck $deck;
    private array $players;
    private int $count = 2;
    private $dealerScore = 0;
    public function __construct(BlackJack $blackJack, Deck $deck)
    {
        	$this->deck = $deck;
            $this->blackJack = $blackJack;
    }
    public function addPlayer(Player $player)
    {
        $this->players[] = $player;
    }
    public function playGame()
    {
        foreach ($this->players as $player) {
            foreach (range(0, 1) as $num) {
                $player->addCard($this->deck->drawCard());
            }
        }
        foreach (range(0, 10) as $num) {
            $this->playRound();
        }
        foreach ($this->players as $player) {
            if ($player->name() !== "Dealer") {
                if ($this->dealerScore === "Busted") {
                    if ($this->getScore($player) !== "Busted") {
                        echo $player->name() . " Wins from the Dealer!" . PHP_EOL;
                    }
                } elseif ($this->getScore($player) === "Busted") {
                    echo "Dealer wins from " . $player->name() . "!" . PHP_EOL;
                } elseif ($this->dealerScore < $this->getScore($player)) {
                    echo $player->name() . " Wins from the Dealer!" . PHP_EOL;
                } else {
                    echo "Dealer wins from " . $player->name() . "!" . PHP_EOL;
                }
            }
        }
        $this->endHand();
    }

    private function playRound() 
    {
        foreach ($this->players as $player) {
            if (count($player->hand()) === $this->count) {
                if ($this->getScore($player) === "Blackjack") {
                    echo $player->name() . " wins! " . $player->name() . " has: " . $this->getScore($player) . PHP_EOL;
                    $this->endHand();
                    exit;
                } elseif ($this->getScore($player) === "Busted" || $this->getScore($player) === "Five card Charlie") {
                    echo $player->name() . " has " . $this->getScore($player) . PHP_EOL;
                    break 1;
                }
            }
        }
        foreach ($this->players as $player) {
            if (count($player->hand()) === $this->count) {
                if ($player->name() === "Dealer") {
                    if ($this->getScore($player) < 18) {
                        echo $player->name() . " has " . $player->showHand() . PHP_EOL;
                        $player->addCard($this->deck->drawCard());
                        $this->dealerScore = $this->getScore($player);
                        $hand = $player->hand();
                        echo $player->name() . " drew " . end($hand) . PHP_EOL;
                    } else {
                        echo $player->name() . " has " . $player->showHand() . PHP_EOL;
                        $this->dealerScore = $this->getScore($player);
                    }
                } else {
                    if ($this->getScore($player) !== "Busted") {
                        $newCard = readline($player->name() . "'s turn. " . $player->name() . " has " . $player->showHand() . " `draw (d) or stop (s)`?...");
                        if ($newCard === "d") {
                            $player->addCard($this->deck->drawCard());
                            $hand = $player->hand();
                            echo $player->name() . " drew " . end($hand) . PHP_EOL;
                        } else {
                            echo $player->name() . " stops!" . PHP_EOL;
                        }
                    }
                }
            }
        }
        $this->count++;
    }
    private function getScore($player): string 
    {
        return $this->blackJack->scoreHand($player->hand());
    }
    private function endHand()
    {
        foreach ($this->players as $player) {
            echo $player->name() . " has " . $player->showHand()  . " => " . $this->getScore($player) . PHP_EOL;
        }
    }
}