<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/post", name="post.")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param PostRepository $postRepository
     * @return Response
     */
    public function index(PostRepository $postRepository)
    {
        // post repository contains methods that allow us to find one or many posts by criteria ,
        // or just everyone that exists , find (), findOneBy(),findAll(),findBy(); (PostRepository.php line 10-13)

        $posts = $postRepository->findAll();

        return $this->render('post/index.html.twig', [
            'posts'=>$posts
        ]);
    }




    /**
     * @Route("/create", name="create")
     */

    public function create(Request $request){
        //TODO - create a new post with title
            $post = new Post();
            $form = $this->createForm(PostType::class, $post);

            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                //entity manager
                $em = $this->getDoctrine()->getManager();
                dump($post);
               // pushes data from $post which is function setTitle with title text into DB
            $em->persist($post);

            //flush is going to contruct insert querry
            $em->flush();

            }



        //return a response
            return $this->redirect($this->generateUrl('post.index'));
    }

    /**
     * @Route("/show/{id}",name="show")
     * @return Response
     */

    public function show(Post $post){

        //dump($post);
        //create show view

        return $this->render('post/show.html.twig',[
            'post' => $post
        ]);

    }

    /**
     * @Route ("/delete/{id}", name="delete")
     */

    public function remove(Post $post){
        $em = $this->getDoctrine()->getManager();

        $em->remove($post);
        $em->flush();

        $this->addFlash('success','Post was removed successfully');

        return $this->redirect($this->generateUrl('post.index'));


    }
}
