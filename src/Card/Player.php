<?php

namespace App\Card;

/**
 * Describes a Player
 */
class Player
{
    /**
     * Constructor to create a Player
     */
    private string $player = '';
    private array $cards = [];

    public function __construct(string $player)
    {
        $this->player = $player;
    }

    public function player(): string
    {
        return $this->player;
    }

    public function playerCards(): array
    {
        return $this->cards;
    }

    public function addCardsToPlayer(Card $card)
    {
        array_push($this->cards, $card);
    }

    public function dealCards($number)
    {
        for ($i = 0; $i < $number; $i++) {
            return array_shift($this->cards);
        }
    }
}
