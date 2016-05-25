<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BlogComment;
use AppBundle\Entity\BlogPost;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $blogPosts = $em->getRepository("AppBundle:BlogPost")->findAll();

        return [
            'blogPosts' => $blogPosts
        ];
    }

    /**
     * @Route("/post/{id}/create_comment", name="create_comment")
     * @ParamConverter("post", class="AppBundle:BlogPost")
     * @Security("has_role('ROLE_ADMIN')")
     * @Template(template="@App/Default/show_default_form.html.twig")
     */
    public function createCommentAction(Request $request, BlogPost $post)
    {
        // just setup a fresh $task object (remove the dummy data)
        $comment = new BlogComment();

        $comment->setPost($post);

        $form = $this->createFormBuilder($comment, ['data_class'=> BlogComment::class])
            ->add('author')
            ->add('content')
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->addFlash('success', 'Comment was created');

            // entityManage manage all related with DB
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/create_post", name="create_post")
     * @Security("has_role('ROLE_ADMIN')")
     * @Template(template="@App/Default/show_default_form.html.twig")
     */
    public function createPostAction(Request $request)
    {
        // just setup a fresh $task object (remove the dummy data)
        $post = new BlogPost();

        $form = $this->createFormBuilder($post)
            ->add('title')
            ->add('content')
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'Post was created');
            // entityManage manage all related with DB
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/comment/{id}/delete", name="delete_comment")
     * @Security("has_role('ROLE_ADMIN')")
     * @ParamConverter("comment", class="AppBundle:BlogComment")
     */
    public function deleteCommentAction(Request $request, BlogComment $comment)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($comment);
        $entityManager->flush();

        $this->addFlash('success', 'Comment was deleted');

        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/post/{id}/delete", name="delete_post")
     * @Security("has_role('ROLE_ADMIN')")
     * @ParamConverter("post", class="AppBundle:BlogPost")
     */
    public function deletePostAction(Request $request, BlogPost $post)
    {
        $entityManager = $this->getDoctrine()->getManager();

        // delete also all comments related with this post
        $entityManager->remove($post);
        $entityManager->flush();

        $this->addFlash('success', 'Comment was deleted');

        return $this->redirectToRoute('home');
    }
}
