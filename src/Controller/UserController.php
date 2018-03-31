<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserController extends Controller {

    /**
     * @Route("/new", name="new_user")
     * Method({"GET"}, "POST"})
     */
    public function new_user() {

        if ($_POST) {
            $entityManager = $this->getDoctrine()->getManager();
            $user = new User();
            $user->setName($_POST['name']);
            $user->setSurname($_POST['surname']);
            $user->setAge($_POST['age']);
            $user->setGender($_POST['gender']);
            $user->setImage($_POST['image']);
            $entityManager->persist($user);
            $entityManager->flush();
            return new Response('User was saved with id' .$user->getId());
        }


    }



    /*public function save() {
        $entityManager = $this->getDoctrine()->getManager();
        $user = new User();
        $user->setName('Yuri');
        $user->setSurname('Pivnenko');
        $user->setAge('22');
        $user->setGender('Male');
        $user->setImage('12413534134');

        $entityManager->persist($user);
        $entityManager->flush();
        return new Response('User was saved with id' .$user->getId());
    }*/
}