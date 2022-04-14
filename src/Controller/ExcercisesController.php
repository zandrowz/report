<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ExcercisesController extends AbstractController
{
    /**
     * @Route("/excercises", name="excercises")
     */
    public function excercises(): Response
    {
        return $this->render('excercises/form/excercises.html.twig');
    }

    /**
     * @Route("/excercises/search", name="form-search")
     */
    public function search(Request $request): Response
    {
        $data = [
            'search' => $request->query->get('search'),
        ];

        return $this->render('excercises/form/search.html.twig', $data);
    }

    /**
     * @Route(
     *      "/excercises/login",
     *      name="form-login",
     *      methods={"GET","HEAD"}
     * )
     */
    public function login(): Response
    {
        return $this->render('excercises/form/login.html.twig');
    }

    /**
     * @Route(
     *      "/excercises/login",
     *      name="form-login-process",
     *      methods={"POST"}
     * )
     */
    public function loginProcess(Request $request): Response
    {
        $user = $request->request->get('user');
        $pwd  = $request->request->get('pwd');

        $type = "notice";
        $isEqual = "NOT";
        if ($user === $pwd) {
            $type = "warning";
            $isEqual = "";
        }

        $this->addFlash($type, "The username and password did $isEqual match.");

        return $this->redirectToRoute('form-login');
    }

    /**
     * @Route(
     *      "/form/session",
     *      name="form-session",
     *      methods={"GET","HEAD"}
     * )
     */
    public function session(): Response
    {
        return $this->render('excercises/form/session.html.twig');
    }

    /**
     * @Route(
     *      "/form/session",
     *      name="form-session-process",
     *      methods={"POST"}
     * )
     */
    public function sessionProcess(
        Request $request,
        SessionInterface $session
    ): Response {
        $roll  = $request->request->get('roll');
        $save  = $request->request->get('save');
        $clear = $request->request->get('clear');

        $sum = $session->get("sum") ?? 0;
        $saved = $session->get("saved") ?? 0;

        if ($roll) {
            $value = random_int(1, 6);
            $sum += $value;
            if ($value === 1) {
                $this->addFlash("error", "You rolled 1 and looses your points.");
                $sum = 0;
            } else {
                $this->addFlash("info", "You rolled $value and adds to your current sum of points.");
            }
            $session->set("sum", $sum);
        } elseif ($save) {
            $this->addFlash("info", "You saved $sum points.");
            $saved += $sum;
            $sum = 0;
            $session->set("saved", $saved);
            $session->set("sum", 0);
        } elseif ($clear) {
            $this->addFlash("warning", "You cleared the game.");
            $sum = 0;
            $saved = 0;
            $session->set("sum", 0);
            $session->set("saved", 0);
        }

        $this->addFlash("info", "You have currently $sum points (not saved).");
        $this->addFlash("info", "You have currently $saved saved points.");

        return $this->redirectToRoute('form-session');
    }
}
