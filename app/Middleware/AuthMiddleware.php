<?php

namespace  App\Middleware;

class AuthMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
          //check if user is not signed in
      if(!$this->container->auth->check()) {

          $this->container->flash->addMessage('error', 'Please sign in before doing that.');
          return $response->withRedirect($this->container->router->pathFor('auth.signin'));
      }

        //flash

        //redirect

        $response = $next($request, $response);
        return  $response;
    }


}