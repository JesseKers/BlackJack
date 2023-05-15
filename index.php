<?php

require_once 'BlackJack.php';
require_once 'Card.php';
require_once 'Dealer.php';
require_once 'Deck.php';
require_once 'Player.php';

$dealer = new Dealer(new BlackJack(), new Deck());
$dealer->addPlayer(new Player('Dealer'));
$dealer->addPlayer(new Player('Ischa'));
$dealer->addPlayer(new Player('Merel'));
$dealer->playGame();