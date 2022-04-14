<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CardController extends AbstractController
{
    /**
     * @Route("/card", name="card")
     */
    public function card(): Response
    {
        return $this->render('card/card.html.twig');
    }

    /**
     * @Route("card/deck", name="deck")
     */
    public function deck(): Response
    {
        $deck = new \App\Card\Deck();


        $data = [
            'title' => 'Deck',
            'deck_cards' => $deck->deck(),
        ];
        return $this->render('card/deck.html.twig', $data);
    }

    /**
     * @Route("card/deck/shuffle", name="shuffle")
     */
    public function shuffle(SessionInterface $session): Response
    {
        $deck = new \App\Card\Deck();

        $data = [
            'title' => 'Shuffle',
            // 'deck' => $deck->shuffle(),
            // 'card' => $card,
            // 'card_show' => $card->getCard(),
            'deck_cards' => $deck->shuffle(),
        ];
        $session->set("deck", $deck);
        return $this->render('card/deck.html.twig', $data);
    }

    /**
     * @Route("card/deck/draw", name="draw")
     */
    public function draw(SessionInterface $session): Response
    {
        $deck = $session->get("deck") ?? new \App\Card\Deck();
        //var_dump($deck->draw());
        $data = [
            'card' => $deck->draw(count($deck->deck())),
            'deck' => $deck->deck(),
        ];

        $session->set("deck", $deck);
        // $data = [
        //     'title' => 'Draw',
        //     'deck' => $deck,
        //     'card' => $deck->draw(),
        //     'deck_cards' => $deck->getCards(),
        // ];
        return $this->render('card/draw.html.twig', $data);
    }

    /**
     * @Route("card/deck/draw/{number}", name="draw-number")
     */
    public function drawNumber(int $number, SessionInterface $session): Response
    {
        $cards = [];
        $deck = $session->get("deck") ?? new \App\Card\Deck();
        for ($i = 1; $i <= $number; $i++) {
            array_push($cards, $deck->draw(count($deck->deck())));
        }
        $data = [
            'cards' => $cards,
            'deck' => $deck->deck(),
        ];

        $session->set("deck", $deck);

        return $this->render('card/drawNr.html.twig', $data);
    }

    /**
     * @Route("/card/deck/deal/{players}/{number}", name="players")
     */
    public function players(int $players, int $number, SessionInterface $session): Response
    {
        $playersArray = [];
        $deck = $session->get("deck") ?? new Deck();
        // $newPlayer = new \App\Card\Player();

        for ($j = 1; $j <= $players; $j++) {
            $newPlayer = new \App\Card\Player(strval($j));
            for ($i = 1; $i <= $number; $i++) {
                $newPlayer->addCardsToPlayer($deck->draw(count($deck->deck())));
            }
            array_push($playersArray, $newPlayer);
        }

        $data = [
            'players' => $playersArray,
            'deck' => $deck->deck(),
        ];
        $session->set("deck", $deck);

        return $this->render('card/players.html.twig', $data);
    }

    /**
     * @Route("card/deck2", name="deck2")
     */
    public function deck2(): Response
    {
        $deck = new \App\Card\Deck2();
        $card = new \App\Card\Card();

        $data = [
            'title' => 'Deck',
            'deck' => $deck,
            'card' => $card,
            'deck_cards' => $deck->deck(),
        ];
        return $this->render('card/deck.html.twig', $data);
    }
}
