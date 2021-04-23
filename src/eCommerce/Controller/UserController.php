<?php

namespace eCommerce\Controller;

use eCommerce\Repository\UserManager;
use Simplex\Templating;
use Simplex\Service\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController
{

    public function register(Request $request): Response
    {
        if (isset($_SESSION) && isset($_SESSION['security']) && $_SESSION['security']['isLoggedIn']) {
            header('Location: /');
            exit;
        }

        if ($request->getMethod() === Request::METHOD_POST) {
            $user = Form::handleSubmit($request);
            $email = (new UserManager())->findByEmail($user->getEmail());

            if ($email) {
                header('Location: /login?email_already_exists');
                exit;
            }
            (new UserManager())->addUser($user);

            header('Location: /register');
            exit;
        }


        $templating = new Templating();

        return new Response(
            $templating->render('eCommerce::register.php', ['test' => 'from register controller']),
            Response::HTTP_OK,
            ['content-type' => 'text/html']
        );
    }


    public function update(Request $request): Response
    {

        if ($request->getMethod() === Request::METHOD_POST) {

            $user = Form::handleSubmit($request);

            dd($user);

            (new UserManager())->updateUser($user);

            header('Location: /profil?success');
            exit;
        }

        $templating = new Templating();

        return new Response(
            $templating->render('eCommerce::profil.php', []),
            Response::HTTP_OK,
            ['content-type' => 'text/html']
        );
    }

    public function login(Request $request): Response
    {
        if (isset($_SESSION) && isset($_SESSION['security']) && $_SESSION['security']['isLoggedIn']) {
            header('Location: /');
            exit;
        }

        if ($request->getMethod() === Request::METHOD_POST) {
            $submittedData = Form::handleSubmit($request);

            $user = (new UserManager())->findByEmail($submittedData->getEmail());

            if (!$user) {
                header('Location: /login?no_user');
                exit;
            }
            if ($user->verifyPassword($submittedData->getPassword())) {

                $_SESSION['security'] = [
                    'user' => $user,
                    'isLoggedIn' => true
                ];

                header('Location: /');
                exit;
            };
        }

        $templating = new Templating();

        return new Response(
            $templating->render('eCommerce::login.php', [])
        );
    }

    public function logout()
    {
        if (!isset($_SESSION['security'])) {
            exit;
        }

        unset($_SESSION['security']);
        header('Location: /login');
    }

    public function profil(Request $request): Response
    {

        $security = false;
        if (isset($_SESSION['security'])) {
            $security = $_SESSION['security'];
        }

        if ($request->getMethod() === Request::METHOD_POST) {

            $user = Form::handleSubmit($request);

            (new UserManager())->updateUser($user);

            $_SESSION['security']['user'] = (new UserManager())->findById($_SESSION['security']['user']->getId());

            dd($user);

            header('Location: /profil?success');
            exit;
        }


        $templating = new Templating();
        return new Response(
            $templating->render('eCommerce::profil.php', ['security' => $security])
        );
    }

    public function deleteProfile(Request $request): Void
    {
        if ($request->getMethod() === Request::METHOD_POST) {


            (new UserManager())->deleteUser($_SESSION['security']['user']);

            unset($_SESSION['security']);

            header('Location: /register');

            exit;
        }
    }
}
