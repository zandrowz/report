<?php

namespace App\Card;

/**
 * Card class
 */
class Card
{
    private string $suit;
    private string $value;

    /**
     * Card constructor.
     */
    public function __construct($suit = '', $value = '')
    {
        $this->suit = $suit;
        $this->value = $value;
    }

    /**Returns the suit of the Card
     * @return string
     */
    public function getSuit()
    {
        return $this->suit;
    }

    /**Returns the Value of the Card
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**Returns the Value and String of the Card
     */
    public function getCard(): string
    {
        return $this->getSuit() . ' ' . $this->getValue();
    }

        public function getColor(): string
    {
        return $this->color;
    }
}
