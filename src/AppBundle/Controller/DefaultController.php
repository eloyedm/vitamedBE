<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Usuario;
use AppBundle\Entity\Cita;
use AppBundle\Entity\Notificacion;

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
        $message = (new \Swift_Message('Bienvenido a Vitalmed'))
          ->setFrom('vital@med.com')
          ->setTo($email)
          // ->setBody( $this->renderView(
          //       'AppBundle::correo.html.twig',
          //       array('name' => $nombre)
          //   ),'text/html')
          ->setBody('<div class="email-container" style="width: 100%;">
            <div class="email-topbar" style="width:60%; margin: auto; height: 40px;">
              <img style="width: 100%; height: 100%;" src="http://www.vitalmed.today/static/img/Barrita1.png" alt="Email Topbar Image">
            </div>
            <div class="email-text" style="width: 30%; margin: auto; min-height: 188px;">
              <div class="text-container" style="max-height: 200px;">
                <p style="text-align: justify; font-size: 18px; display: block; margin: 15% 0;">
                  Muchas gracias,'.$nombre.'
                  Esperamos tu tiempo con nosotros sea de tu agrado y que aproveches todas
                  las funciones que podemos ofrecerte en este sitio. A contunuaci�n te
                  ofrecemos un link para activar tu cuenta y llevarte a una introducci�n a
                  nuestra apliaci�n, te sera muy util y en cuesti�n de minutos ya podras
                  empezar a agendar todas tus citas.
                </p>
                <img style="opacity: 0.2; position: relative; z-index: -1; left: 15%; top: -235px; display: block;" src="http://www.vitalmed.today/static/img/Logo.png" style="opacity: 0.4;">
              </div>
            </div>
            <div class="email-contact" style="width: 69%; margin: auto; height: 48px;">
              <a href="http://www.vitalmed.today/welcome"><img style="width: 100%; height: 100%;" src="http://www.vitalmed.today/static/img/Barrita2.png"></a>
            </div>
          </div>','text/html')
          /*
           * If you also want to include a plaintext version of the message
          ->addPart(
              $this->renderView(
                  'Emails/registration.txt.twig',
                  array('name' => $name)
              ),
              'text/plain'
          )
          */
        ;

        $this->get('mailer')->send($message);
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
         $token = bin2hex(random_bytes(24));
         $usuario->setConfirmationToken($token);
         $em->flush();

         if($encoded_pass == $savedPass){
           return new JsonResponse(array(
             'status' => 202,
             'response' => 'succesfully logged in',
             'data' => array(
               'token' => $token
             )
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
     return new JsonResponse(array(
       'status' => 202,
       'response' => 'succesfully logged in',
       'citas' => $query->getResult()
     ));
    }

     /**
    * @Route("/services/recordatorios", name="Recordatorios")
    */
    public function remindersAction(Request $request){
      $em = $this->getDoctrine()->getManager();
      $user = $request->request->get('user');
      $query = $em->createQuery("SELECT n.idnotificacion as notificacion, n.fechan as fecha, concat(d.nombred, ' ', d.apellidopd) AS doctor, co.nombrecon as consultorio, ci.idcita AS cita
      FROM AppBundle\Entity\Notificacion n
      LEFT JOIN n.citan ci
      LEFT JOIN ci.doctorc d
      LEFT JOIN ci.consultorioc co
      LEFT JOIN ci.usuarioc u
      WHERE u.username = :user");
      $query->setParameter('user', $user);
      return new JsonResponse(array(
        'status' => 202,
        'response' => 'succesfully logged in',
        'citas' => $query->getResult()
      ));
    }

    /**
    * @Route("/services/check", name="check")
    */
    public function checkServiceAction(Request $request){
      $name = 'eloy.edm@gmail.com';
      $em = $this->getDoctrine()->getManager();
      $usuario = $this->getDoctrine()->getRepository('AppBundle\Entity\Usuario')->findOneBy(array('correou' => $name));

      dump($usuario);
      die();
    }

    /**
    * @Route("/services/validate", name="validate")
    */
    public function validateServiceAction(Request $request){
      $em = $this->getDoctrine()->getManager();
      $user = $request->request->get('user');
      $token = $request->request->get('token');
      $usuario = $this->getDoctrine()->getRepository('AppBundle\Entity\Usuario')->findOneBy(array('correou' => $user, 'confirmationToken' => $token));

      if($usuario != null){
       return new JsonResponse(array(
         'status' => 202,
         'response' => 'succesfully validate'
       ));
      }else{
       return new JsonResponse(array(
         'status' => 404
       ));
      }
    }

    /**
    * @Route("/services/cita", name="createDate")
    */
    public function createDateServiceAction(Request $request){
     $em = $this->getDoctrine()->getManager();
     $cita = new Notificacion();

     $fecha = $request->request->get('fecha');
     $hora = $request->request->get('hora');
     $consultorio = $request->request->get('consultorio');
     $user = $request->request->get('user');
     $userEntity = $em->getRepository('AppBundle\Entity\Usuario')->findOneBy(array('correou' => $user));
     $consultorioEntity = $em->getRepository('AppBundle\Entity\Consultorio')->findOneBy(array('idconsultorio' => $consultorio));
     $cita->setFechan(new \DateTime($fecha));
     $cita->setHoran(new \DateTime($hora));
     $cita->setUsuarion($userEntity);
     $cita->setConsultorion($consultorioEntity);
     $cita->setTipo(2);
     $em->persist($cita);
     $em->flush();

     if($cita != null){
       return new JsonResponse(array(
         'status' => 202,
         'response' => 'succesfully create cita'
       ));
     }else{
       return new JsonResponse(array(
         'status' => 404
       ));
     }
    }

    /**
    * @Route("/services/solicitar/cita")
    */
    public function requestDateServiceAction(Request $request){
      $em = $this->getDoctrine()->getManager();
      $consultorios = $em->getRepository('AppBundle\Entity\Consultorio')->findBy(array('isespecialidad' => 0));
      $doctors = $em->getRepository('AppBundle\Entity\Doctor')->findAll();
      $randomCons = array_rand($consultorios, 1);
      $randomDoc = array_rand($doctors, 1);
      $pickedCons = array(
        'consultorio' => $consultorios[$randomCons]->getNombreCon(),
        'idconsultorio' => $consultorios[$randomCons]->getIdconsultorio()
      );
      $pickedDoc = array(
        'nombre' => $doctors[$randomDoc]->getNombred().' '.$doctors[$randomDoc]->getApellidoPd().' '.$doctors[$randomDoc]->getApellidoMd(),
        'iddoctor' => $doctors[$randomDoc]->getIddoctor()
      );
      return new JsonResponse(array(
        'status' => 202,
        'response' => 'succesfully aqui esta tu cita posible',
        'consultorio' => $pickedCons,
        'doctor' => $pickedDoc
      ));
    }

    /**
    * @Route("/services/create/cita")
    */
    public function addDateServiceAction(Request $request){
      $em = $this->getDoctrine()->getManager();
      $cita = new Cita();

      $fecha = $request->request->get('fecha');
      $hora = $request->request->get('hora');
      $consultorio = $request->request->get('consultorio');
      $doctor = $request->request->get('doctor');
      $user = $request->request->get('user');
      $userEntity = $em->getRepository('AppBundle\Entity\Usuario')->findOneBy(array('correou' => $user));
      $consultorioEntity = $em->getRepository('AppBundle\Entity\Consultorio')->findOneBy(array('idconsultorio' => $consultorio));
      $doctorEntity = $em->getRepository('AppBundle\Entity\Doctor')->findOneBy(array('iddoctor' => $doctor));
      $cita->setFechac(new \DateTime($fecha));
      $cita->setHorac(new \DateTime($hora));
      $cita->setUsuarioc($userEntity);
      $cita->setConsultorioc($consultorioEntity);
      $cita->setDoctorc($doctorEntity);
      $em->persist($cita);
      $em->flush();

      if($cita != null){
        return new JsonResponse(array(
          'status' => 202,
          'response' => 'succesfully create cita'
        ));
      }else{
        return new JsonResponse(array(
          'status' => 404
        ));
      }
    }


    /**
    * @Route("/services/especialidad", name="createEspecial")
    */
    public function createDateEspecialServiceAction(Request $request){
      $em = $this->getDoctrine()->getManager();
      $cita = new Notificacion();

      $fecha = $request->request->get('fecha');
      $hora = $request->request->get('hora');
      $consultorio = $request->request->get('consultorio');
      $user = $request->request->get('user');
      $userEntity = $em->getRepository('AppBundle\Entity\Usuario')->findOneBy(array('correou' => $user));
      $consultorioEntity = $em->getRepository('AppBundle\Entity\Consultorio')->findOneBy(array('idconsultorio' => $consultorio));
      $cita->setFechan(new \DateTime($fecha));
      $cita->setHoran(new \DateTime($hora));
      $cita->setUsuarion($userEntity);
      $cita->setConsultorion($consultorioEntity);
      $cita->setTipo(3);
      $em->persist($cita);
      $em->flush();

      if($cita != null){
       return new JsonResponse(array(
         'status' => 202,
         'response' => 'succesfully create cita'
       ));
      }else{
       return new JsonResponse(array(
         'status' => 404
       ));
      }
    }

    /**
    * @Route("/services/get/recetas")
    */
    public function recetasListServiceAction(Request $request){
      $em = $this->getDoctrine()->getManager();
      $user = $request->request->get('user');
      $query = $em->createQuery("SELECT
        n.idnotificacion as notificacion,
        n.fechan as fecha,
        n.horan as hora,
        n.mensajen as mensaje
        FROM AppBundle\Entity\Notificacion n
        LEFT JOIN n.usuarion u
        WHERE u.username = :user
        AND n.tipo = 1");
      $query->setParameter('user', $user);

      return new JsonResponse(array(
        'status' => 202,
        'recetas' => $query->getResult()
      ));
    }

    /**
    * @Route("/services/get/general")
    */
    public function generalListServiceAction(Request $request){
      $em = $this->getDoctrine()->getManager();
      $user = $request->request->get('user');
      $query = $em->createQuery("SELECT
        n.idnotificacion as notificacion,
        n.fechan as fecha,
        n.horan as hora,
        n.mensajen as mensaje,
        con.nombrecon as consultorio
        FROM AppBundle\Entity\Notificacion n
        LEFT JOIN n.usuarion u
        LEFT JOIN n.consultorion con
        WHERE u.username = :user
        AND n.tipo = 2");
      $query->setParameter('user', $user);

      return new JsonResponse(array(
        'status' => 202,
        'citas' => $query->getResult()
      ));
    }

    /**
    * @Route("/services/get/especial")
    */
    public function especiallListServiceAction(Request $request){
      $em = $this->getDoctrine()->getManager();
      $user = $request->request->get('user');
      $query = $em->createQuery("SELECT
        n.idnotificacion as notificacion,
        n.fechan as fecha,
        n.horan as hora,
        n.mensajen as mensaje,
        con.nombrecon as consultorio
        FROM AppBundle\Entity\Notificacion n
        LEFT JOIN n.usuarion u
        LEFT JOIN n.consultorion con
        WHERE u.username = :user
        AND n.tipo = 3");
      $query->setParameter('user', $user);

      return new JsonResponse(array(
        'status' => 202,
        'citas' => $query->getResult()
      ));
    }

    /**
    * @Route("/services/userinfo")
    */
    public function userInfoServiceAction(Request $request){
      $em = $this->getDoctrine()->getManager();
      $user = $request->request->get('user');
      $query = $em->createQuery("SELECT
        u.nombreu as nombre,
        u.apellidopu as apellidop,
        u.apellidomu as apellidom
        FROM AppBundle\Entity\Usuario u
        WHERE u.username = :user");
      $query->setParameter('user', $user);
      return new JsonResponse(array(
        'status' => 202,
        'info' => $query->getResult()
      ));
    }

    /**
    * @Route("/services/get/general/grouped")
    */
    public function generalListByDateServiceAction(Request $request){
      $em = $this->getDoctrine()->getManager();
      $user = $request->request->get('user');
      $query = $em->createQuery("SELECT
        n.idnotificacion as notificacion,
        n.fechan as fecha,
        n.horan as hora,
        n.mensajen as mensaje,
        con.nombrecon as consultorio
        FROM AppBundle\Entity\Notificacion n
        LEFT JOIN n.usuarion u
        LEFT JOIN n.consultorion con
        WHERE u.username = :user
        AND n.tipo = 2");
      $query->setParameter('user', $user);
      $months = array(0,0,0,0,0,0,0,0,0,0,0,0);
      $dates = $query->getResult();
      foreach ($dates as $key => $value) {
        $newMonth = $value['fecha']->format('m')-1;
        $months[$newMonth]++;
      }
      // dump($query->getResult());
      return new JsonResponse(array(
        'status' => 202,
        'citas' => $months
      ));
    }

    /**
    * @Route("/services/consultorioslist")
    */
    public function getConsultoriosServiceAction(Request $request){
     $em = $this->getDoctrine()->getManager();

     $query = $em->createQuery("SELECT co.nombrecon as consultorio, co.idconsultorio as numero
     FROM AppBundle\Entity\Consultorio co WHERE co.isespecialidad = 0");

     $consultorios = $query->getResult();
     if($consultorios != null){
       return new JsonResponse(array(
         'status' => 202,
         'response' => 'succesfully retrieved consultorios',
         'consultorios' => $consultorios
       ));
     }else{
       return new JsonResponse(array(
         'status' => 404
       ));
     }
    }

    /**
    * @Route("/services/consultoriosesplist")
    */
    public function getConsultoriosEspecialidadServiceAction(Request $request){
     $em = $this->getDoctrine()->getManager();

     $query = $em->createQuery("SELECT co.nombrecon as consultorio, co.idconsultorio as numero
     FROM AppBundle\Entity\Consultorio co WHERE co.isespecialidad = 1");

     $consultorios = $query->getResult();
     if($consultorios != null){
       return new JsonResponse(array(
         'status' => 202,
         'response' => 'succesfully retrieved consultorios',
         'consultorios' => $consultorios
       ));
     }else{
       return new JsonResponse(array(
         'status' => 404
       ));
     }
    }

    /**
    * @Route("/services/sendmail")
    */
    public function sendMailAction(){
      $email = 'eloy.edm@gmail.com';
      $nombre = 'Eloy Eduardo';
      $message = (new \Swift_Message('Bienvenido a Vitalmed'))
        ->setFrom('vital@med.com')
        ->setTo($email)
        // ->setBody( $this->renderView(
        //       'AppBundle::correo.html.twig',
        //       array('name' => $nombre)
        //   ),'text/html')
        ->setBody('<div class="email-container" style="width: 100%;">
          <div class="email-topbar" style="width:60%; margin: auto; height: 40px;">
            <img style="width: 100%; height: 100%;" src="http://www.vitalmed.today/static/img/Barrita1.png" alt="Email Topbar Image">
          </div>
          <div class="email-text" style="width: 30%; margin: auto; min-height: 188px;">
            <div class="text-container" style="max-height: 200px;">
              <p style="text-align: justify; font-size: 18px; display: block; margin: 15% 0;">
                Muchas gracias,'.$nombre.'
                Esperamos tu tiempo con nosotros sea de tu agrado y que aproveches todas
                las funciones que podemos ofrecerte en este sitio. A contunuaci�n te
                ofrecemos un link para activar tu cuenta y llevarte a una introducci�n a
                nuestra apliaci�n, te sera muy util y en cuesti�n de minutos ya podras
                empezar a agendar todas tus citas.
              </p>
              <img style="opacity: 0.2; position: relative; z-index: -1; left: 15%; top: -235px; display: block;" src="http://www.vitalmed.today/static/img/Logo.png" style="opacity: 0.4;">
            </div>
          </div>
          <div class="email-contact" style="width: 69%; margin: auto; height: 48px;">
            <a href="http://www.vitalmed.today/welcome"><img style="width: 100%; height: 100%;" src="http://www.vitalmed.today/static/img/Barrita2.png"></a>
          </div>
        </div>','text/html')
        /*
         * If you also want to include a plaintext version of the message
        ->addPart(
            $this->renderView(
                'Emails/registration.txt.twig',
                array('name' => $name)
            ),
            'text/plain'
        )
        */
      ;

      $this->get('mailer')->send($message);
      return new JsonResponse(array(
        'status' => 202,
        'response' => 'succesfully create cita'
      ));
    }

    /**
    * @Route("/services/receta")
    */
    public function recetasAction(Request $request){
      $em = $this->getDoctrine()->getManager();
      $notificacion = new Notificacion();

      $fecha = $request->request->get('fecha');
      $hora = $request->request->get('hora');
      $user = $request->request->get('user');
      $userEntity = $em->getRepository('AppBundle\Entity\Usuario')->findOneBy(array('correou' => $user));
      if(count($userEntity) > 0){
        $notificacion->setFechan(new \DateTime($fecha));
        $notificacion->setHoran(new \DateTime($hora));
        $notificacion->setUsuarion($userEntity);
        $notificacion->setTipo(1);
        $notificacion->setMensajen('Recuerda rellenar tu receta');

        $em->persist($notificacion);
        $em->flush();
        return new JsonResponse(array(
          'status' => 202,
          'response' => 'succesfully saved receta'
        ));
      }
      else{
        return new JsonResponse(array(
          'status' => 500,
          'response' => 'Something went wrong'
        ));
      }
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
