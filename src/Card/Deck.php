<?php

namespace App\Card;

/**
 * Deck class
 */
class Deck
{
    protected array $deck = [];
    private array $suits = ["♠️", "♣️", "♦️", "❤"];
    private array $values = [2, 3, 4, 5, 6, 7, 8, 9, 10, "Kn", "Q", "K", "A"];

    /**
     * Constructor to create a Deck
     */
    public function __construct()
    {
        $this->deck = array();
        foreach ($this->suits as $suit) {
            foreach ($this->values as $value) {
                array_push($this->deck, new Card($suit, $value));
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

    public function draw($deckNr)
    {
        $random = rand(0, $deckNr - 1);
        $card = $this->deck[$random];
        array_splice($this->deck, $random, 1);
        return $card;
    }

    /**
     * Draw a card from the deck
     */
    // public function draw()
    // {
    //     $shuffled_cards = self::shuffle($this->cards);
    //     if (count($this->cards)> 0) {
    //         $drawn = array_shift($this->cards);
    //     } else {
    //         $drawn = null;
    //     }

    //     $numberOfCards = count($this->cards);

    //     $deck = $this->cards;

    //     return [$drawn, $numberOfCards];
    // }

    // public function drawCards($number) {
    //     self::shuffle($this->cards);
    //     return array_splice($this->cards, 0, $number);
    // }

    /**Deals number of Cards from the deck
     * @param $numberOfCardsToDeal
     */
}
