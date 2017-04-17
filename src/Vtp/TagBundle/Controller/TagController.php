<?php

namespace Vtp\TagBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TagController extends Controller
{

    /**
     * @param Request $request
     *
     * @Route("/tags.json", name="tag_index")
     */
    public function indexAction(Request $request)
    {
        $serializer = $this->get('jms_serializer');
        return new Response($serializer->serialize($this->getDoctrine()->getRepository("TagBundle:Tag")->findAll(), 'json'));
    }
}
