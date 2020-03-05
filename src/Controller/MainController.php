<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    // TODO - default route with custom text display

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig');
    }


    // TODO - defines route with parameter it contains and value it'll return
    /**
     *  @Route("/custom/{name?}", name="custom")
     * @param Request $request
     * @return Response
     */

    public function custom(Request $request){
        $name = $request->get('name');
        return $this->render('home/custom.html.twig',[
            'name' => $name
        ]);
    }










}
