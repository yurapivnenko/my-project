<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Method=({"GET"})
     */
    public function index()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('user/index.html.twig', array('users' => $users));
    }

    /**
     * @Route("/user/new", name="new_user")
     * @Method({"GET", "POST"})
     */
    public function newUser(Request $request)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->add('save', SubmitType::class, array(
            'label' => 'Create user',
            'attr' => array('class' => 'btn btn-lg btn-primary btn-block mt-3')
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('user/new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/user/edit/{id}", name="edit_user")
     * @Method({"GET", "POST"})
     */
    public function editUser(Request $request, $id)
    {
        $user = new User();
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        $form = $this->createForm(UserType::class, $user);
        $form->add('save', SubmitType::class, array(
            'label' => 'Update user',
            'attr' => array('class' => 'btn btn-lg btn-primary btn-block mt-3')
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('user/edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/user/{id}"), name="user_show"
     * @Method({"GET"})
     */
    public function showUser($id)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        return $this->render('user/show.html.twig', array('user' => $user));
    }

    /**
     * @Route("/user/delete/{id}", name="delete_user")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($user);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }
}