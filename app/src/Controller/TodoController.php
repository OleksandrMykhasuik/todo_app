<?php

namespace App\Controller;

use App\Component\Message\MessageGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TodoController extends AbstractController
{
    #[Route('/todo', name: 'app_todo')]
    public function index(MessageGeneratorInterface $messageGenerator): Response
    {
        $message = $messageGenerator->generateRandomString();
        return $this->render('todo/index.html.twig', [
            'message' => $message,
            'controller_name' => 'TodoController',
        ]);
    }
}
