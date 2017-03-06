<?php

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use FOS\UserBundle\Controller\SecurityController as BaseController;

class SecurityController extends BaseController
{

    /**
     * @Route("/login", name="login")
     * @Template()
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        if ($error) {
            if (get_class($error) == 'Symfony\Component\Security\Core\Exception\BadCredentialsException') {
                $this->setMensaje('error', 'Código de usuario y/o número de referencia son incorrectos. Verifique el código y número de referencia que figura en la clave de acceso que le entregó el banco.');
            }
        }

        return $this->renderLogin(array(
            'last_username' => $lastUsername,
            'error' => $error,
        ));
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {

        $this->container->get('security.context')->setToken(null);

        return $this->redirect($this->generateUrl('login'));

    }


    /**
     * @Route("/redirect_to_user", name="redirect_to_path")
     */
    public function redirectToPathAction(Request $request)
    {
        $usuario = $this->getUser();
        //Verificar que se haya obtenido el usario
        if (!$usuario) {

            return $this->redirect($this->generateUrl('login'));
        }

        $autorization = $this->container->get("security.authorization_checker");

        if (!$this->ip_pertenece_a_red($request->getClientIp(), $usuario->getDireccionIp())) {
            $this->container->get('security.context')->setToken(null);
            $this->setMensaje('error', 'Acceso Denegado. El usuario no está autorizado para ingresar a través de la dirección IP: ' . $request->getClientIp());

            return $this->redirect('login');
        }


        if ($autorization->isGranted("ROLE_USER")) {
            return new RedirectResponse($this->generateUrl("management_homepage"));
        }

        return new RedirectResponse($this->generateUrl("index"));
    }

    /**
     * @Route("/manual", name="login_manual")
     * @Template()
     */
    public function manualAction()
    {
        return array();
    }

    /**
     * @Cache(expires="+7 days")
     * @Route("/olvide-pass", name="login_olvide_pass")
     * @Template()
     */
    public function lostPasswordAction()
    {
        return array();
    }


    /**
     * Colocar un mensaje como flashbag.
     * En la vista se mostrara el mensaje que corresponda a la acción que se ha ejecutado previamente en el sistema.
     *
     * @param string $tipo (error, warning, success)
     * @param string $mensaje el mensaje correspondiente
     */
    public function setMensaje($tipo, $mensaje)
    {
        $this->get('session')->getFlashBag()->add($tipo, $mensaje);
    }

    /**
     * Obtener el usuario que se ha logueado en el sistema
     *
     * @return Usuario
     */
    public function getUser()
    {
        global $kernel;
        $token = $kernel->getContainer()->get('security.token_storage')->getToken();
        if (!is_object($user = $token->getUser())) {
            return null;
        }

        return $user;
    }

    private function ip_pertenece_a_red($str_ip, $str_rango)
    {
        if ($str_rango == '0.0.0.0') {

            $username = $this->getUser()->getUsername();
            if ($username == 'jeffer' || $username == '1130586353') {
                return true;

            } else {
                return false;
            }
        }
        // Extraemos la máscara
        list($str_red, $str_mascara) = array_pad(explode('/', $str_rango), 2, NULL);
        if (is_null($str_mascara)) {
            // No se especifica máscara: el rango es una única IP
            $mascara = 0xFFFFFFFF;
        } elseif ((int)$str_mascara == $str_mascara) {
            // La máscara es un entero: es un número de bits
            $mascara = 0xFFFFFFFF << (32 - (int)$str_mascara);
        } else {
            // La máscara está en formato x.x.x.x
            $mascara = ip2long($str_mascara);
        }

        $ip = ip2long($str_ip);
        $red = ip2long($str_red);
        $inf = $red & $mascara;
        $sup = $red | (~$mascara & 0xFFFFFFFF);

        return $ip >= $inf && $ip <= $sup;
    }


}
