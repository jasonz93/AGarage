<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-2-21
 * Time: 下午1:15
 */

namespace AGarage\Site\Controller\Blog;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{
    /**
     * @Route("/{_locale}/blog", name="blog", requirements={"_locale" = "%locales%"})
     */
    public function indexAction(Request $request) {
        $topic = $this->getDoctrine()->getRepository('AGarageSiteBundle:Blog\BlogTopic')
            ->find(1);
        return $this->render('blog/index.html.twig', [
            'topic' => $topic
        ]);
    }
}