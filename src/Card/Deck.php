<?php

namespace App\Card;

/**
 * Deck class
 */
class Deck
{
    protected array $deck = [];
    //private array $suits = ["♠", "♣", "♦", "♥"];
    //private array $suits = ["spades", "&hearts;", "diamonds", "clubs"];
    private array $suits = ['♥' => 'red', '♦' => 'red', '♠' => 'black', '♣' => 'black'];
    private array $values = [2, 3, 4, 5, 6, 7, 8, 9, 10, "Kn", "Q", "K", "A"];

    /**
     * Constructor to create a Deck
     */
    public function __construct()
    {
        $this->deck = [];
        foreach ($this->suits as $suitkey => $suitvalue) {
            foreach ($this->values as $value) {
                array_push($this->deck, new Card("<font style='color:$suitvalue'> {$value} {$suitkey}</font>"));
            }
        }
    }

    public function deck()
    {
        return $this->deck;
    }

    /** Shuffle the deck
     */
    public function shuffle()
    {
        shuffle($this->deck);
        return $this->deck;
        //$this->cards = shuffle($this->cards);
    }

    public function drawCard(): Card | null
    {
        return array_pop($this->deck);
    }

}
