<?php

class Player
{
    private string $name;
    private array $hand;
    public function __construct(string $name)
    {
        $this->name = $name;
    }
    public function addCard(Card $card): string
    {
        $this->hand[] = $card->show();
        return $card->show();
    }
    public function showHand(): string
    {
        return implode(" ", $this->hand);
    }
    public function name(): string 
    {
        return $this->name;
    }
    public function hand(): array
    {
        return $this->hand;
    }
}