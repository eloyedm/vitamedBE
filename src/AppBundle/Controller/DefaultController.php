<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Usuario;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }

    /**
     * @Route("/services/register", name="Registro")
     */
    public function registerAction(Request $request){
        $usuario = $request->request->get('usuario');
        $em = $this->getDoctrine()->getManager();
        $password = $request->request->get('password');
        $nombre = $request->request->get('nombre');
        $email = $request->request->get('email');
        $apellidoP = $request->request->get('apellidoP');
        $apellidoM = $request->request->get('apellidoM');

        $newUser = new Usuario();
        $encoder_service = $this->get('security.encoder_factory');
        $encoder = $encoder_service->getEncoder($newUser);
        $encoded_pass = $encoder->encodePassword($password, $newUser->getSalt());
        $newUser->setNombreu($nombre);
        $newUser->setUsername($email);
        $newUser->setEmail($email);
        $newUser->setApellidopu($apellidoP);
        $newUser->setApellidomu($apellidoM);
        $newUser->setCorreou($email);
        $newUser->setContrau($encoded_pass);
        $newUser->setPassword($encoded_pass);

        $em->persist($newUser);
        $em->flush();

        return new JsonResponse(array(
          'status' => 202,
          'response' => 'succesfully created user'
        ));
     }

     /**
      * @Route("/services/login", name="Inicio")
      */
    public function loginServiceAction(Request $request){
         $em = $this->getDoctrine()->getManager();
         $password = $request->request->get('password');
         $email = $request->request->get('email');

         $newUser = new Usuario();
         $encoder_service = $this->get('security.encoder_factory');
         $encoder = $encoder_service->getEncoder($newUser);

         $usuario = $this->getDoctrine()->getRepository('AppBundle\Entity\Usuario')->findOneBy(array('correou' => $email));

         $encoded_pass = $encoder->encodePassword($password, $usuario->getSalt());
         $savedPass = $usuario->getPassword();

         if($encoded_pass == $savedPass){
           return new JsonResponse(array(
             'status' => 202,
             'response' => 'succesfully logged in'
           ));
         }else{
           return new JsonResponse(array(
             'status' => 403,
             'response' => 'Unauthorized access'
           ));
         }
      }

      /**
     * @Route("/services/dashboard", name="Dashboard")
     */
     public function dashboardAction(Request $request){
       $em = $this->getDoctrine()->getManager();
       $user = $request->request->get('user');
       $query = $em->createQuery("SELECT c.idcita as cita, c.fechac as fecha, concat(d.nombred, ' ', d.apellidopd) AS doctor, co.nombrecon as consultorio
       FROM AppBundle\Entity\Cita c
       LEFT JOIN c.usuarioc u
       LEFT JOIN c.doctorc d
       LEFT JOIN c.consultorioc co
       WHERE u.username = :user");
       $query->setParameter('user', $user);
      dump($query->getResult());
      die();
     }

    /**
     * @Route("/registro", name="Signin")
     */
    public function siginAction(){
      return $this->render("AppBundle::signin.html.twig", array(
      ));
    }

     /**
      * @Route("/iniciosesion", name="InicioSesion")
      */
     public function loginAction(){
       return $this->render("AppBundle::login.html.twig", array(
        ));
     }

     /**
      * @Route("/home", name="Home")
      */
     public function homeAction(){
       return $this->render("AppBundle::home.html.twig", array(
        ));
     }
}
