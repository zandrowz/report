<?php

namespace App\Card;

/**
 * Represents Deck2 with 2 jokers
 */
class Deck2 extends Deck
{
    // private array $cards = [];
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        array_push($this->deck, new Card("J", "🃏"));
        array_push($this->deck, new Card("J", "🃏"));
    }

    public function getCards()
    {
        return $this->deck;
    }
}
