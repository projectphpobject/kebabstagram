<?php

namespace  App\Controllers\Auth;
use App\Models\User;
use App\Controllers\Controller;
use Respect\Validation\Validator as v;
class AuthController extends Controller
{
    public function getSignOut($request, $response)
    {

        $this->auth->logout();
        $this->flash->addMessage('info', 'You have been signed out!');
        return $response->withRedirect($this->router->pathFor('home'));
    }





    public function  getSignIn($request, $response)
    {

        return $this->view->render($response, 'auth/signin.twig');

    }

    public function  postSignIn($request, $response)
    {

        $auth = $this->auth->attempt(
            $request->getParam('email'),
            $request->getParam('password')

        );
        if(!$auth){
            $this->flash->addMessage('error', 'Could not sign you in with those details.');
            return $response->withRedirect($this->router->pathFor('auth.signin'));
        }
        $this->flash->addMessage('info', 'You have been signed up!');
        return $response->withRedirect($this->router->pathFor('home'));
    }

    public function  getSignUp($request, $response)
    {

        return $this->view->render($response, 'auth/signup.twig');

    }

    public function postSignUp($request, $response)
    {

        $validation = $this->validator->validate($request, [

            'email'  => v::noWhitespace()->notEmpty()->email()->emailAvailable(),
            'nom'  =>  v::notEmpty()->alpha(),

            'password'  => v::noWhitespace()->notEmpty()

        ]);

        if($validation->failed())
        {

            return $response->withRedirect($this->router->pathFor('auth.signup'));
        }
        $user = User::create([

            'email'    => $request->getParam('email'),
            'nom'      => $request->getParam('nom'),
            'prenom'   => $request->getParam('prenom'),
            'pseudo'   => $request->getParam('pseudo'),
            'password' => password_hash($request->getParam('password'),PASSWORD_DEFAULT),
        ]);

        $this->flash->addMessage('info', 'You have been signed up!');
        $this->auth->attempt($user->email, $request->getParam('password'));


        return $response->withRedirect($this->router->pathFor('home'));
    }


}