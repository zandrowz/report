<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// use App\Card\Deck;

class JsonController extends AbstractController
{
    /**
     * @Route("/card/api/deck", name="jsonapi")
     */
    public function jsonapi(): Response
    {
        $cardsArray = [];
        $deck = new \App\Card\Deck();
        $cards = $deck->deck();

        for ($i = 0; $i < count($cards); $i++) {
            array_push($cardsArray, $cards[$i]->getCard());
        }

        $data = [
            'title' => 'JSON deck',
            'deck' => $cardsArray,
        ];

        return new JsonResponse($data);
    }
}
