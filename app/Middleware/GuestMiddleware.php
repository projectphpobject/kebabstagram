<?php

namespace  App\Middleware;

class GuestMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        //check if user is not signed in
        if($this->container->auth->check()) {

            return $response->withRedirect($this->container->router->pathFor('home'));
        }

        //flash

        //redirect

        $response = $next($request, $response);
        return  $response;
    }


}