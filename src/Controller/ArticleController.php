<?php


namespace App\Controller;


//use http\Env\Response;
use App\Service\Markdownhelper;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(): Response
    {
        return $this->render('article/homepage.html.twig', [
            'title' => '',
            'comments' => [],
        ]);
        //dodavanje stranice
        //return new Response('Go!');
    }

    /**
     * @Route("/article/{slug}", name="article_show")
     */
    public function showAction($slug, Markdownhelper $markdownhelper)
    {


        $comments = [
            'I ate a normal rock once. It did NOT taste like bacon!',
            'Woohoo! I\'m going on an all-asteroid diet!',
            'I like bacon too! Buy some from my site! bakinsomebacon.com',
        ];

        $articleContent = <<<EOF
Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,
lorem proident [beef ribs](https://baconipsum.com) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit
labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow
turkey shank eu pork belly meatball non **cupim**.
EOF;
        //$articleContent = $markdown->transform($articleContent);
        ////markamo i oznacavamo tekst

        //dump($cache);die;
        //ovako nije dobro jer nemoze da se testira pa pravimo posebnu klasu sopstveni servis
       $articleContent = $markdownhelper->parse($articleContent);//ovako pvamo service



        return $this->render('article/show.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'slug' => $slug,
            'articleContent' => $articleContent,
            'comments' => $comments,
        ]);//prvo slovo veliko i '-' ako pronadje sa ' ' menja
    }

    /**
     * @Route("/article/{slug}/heart", name="article_toggle_heart", methods={"POST"})
     */
    public function toggleArticleHeart($slug, LoggerInterface $logger)
    {

        $logger->info('Article is being hearted');

        //return new Response(json_encode(['hearts' => 5]));
        return new JsonResponse(['heart' => rand(5, 100)]);
        // return $this->json(['heart' =>rand(5,100)]);
    }

}