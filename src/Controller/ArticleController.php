<?php


namespace App\Controller;


//use http\Env\Response;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController
{
    /**
     * @Route("/")
     */
    public function homepage(): Response
    {
        return new Response('Go!');
    }

    /**
     * @Route("/news/{slug}")
     */
    public function show($slug){
        //return new Response('Asteroids bacon');
        return new Response(sprintf(
            'Asteroids slug: %s',
            $slug
        ));
    }

}