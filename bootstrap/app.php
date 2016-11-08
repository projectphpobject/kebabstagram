<?php
use Respect\Validation\Validator as v;
use App\Models\User;
use App\Models\Notation;
session_start();
require __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../config.php';


DB\Connection::bootEloquent("config.ini");
$app = new \Slim\App();


//for displaying errors

$app= new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true

            ],

]);

$container= $app->getContainer();


$container['auth'] = function($container) {

    return new \App\Auth\Auth;
};

$container['flash'] = function ($container) {

    return new \Slim\Flash\Messages;
};



$container['view'] = function ($container) {

    $view = new \Slim\Views\Twig(__DIR__. '/../resources/views', [
        'cache' =>  false,

    ]);

    $view->addExtension( new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    $view->getEnvironment()->addGlobal('auth',[

        'check' => $container->auth->check(),
        'user' => $container->auth->user(),
    ]);


    $view->getEnvironment()->addGlobal('flash', $container->flash);


    return $view;
};

$container['validator'] = function ($container)
{
    return new App\Validation\Validator;

};


$container['KebabController'] = function ($container) {

    return  new \App\Controllers\KebabController($container);

};

$container['AuthController'] = function ($container) {

    return  new \App\Controllers\Auth\AuthController($container);

};

$container['PasswordController'] = function ($container) {

    return  new \App\Controllers\Auth\PasswordController($container);

};

$container['csrf'] = function($container) {

    return new \Slim\Csrf\Guard;
};



$app->add(new \App\Middleware\ValidationErrorsMiddleware($container));
$app->add(new \App\Middleware\OldInputMiddleware($container));
$app->add(new \App\Middleware\CsrfViewMiddleware($container));

$app->add($container->csrf);
if($_POST['idBox'] &&  isset($_SESSION['user'])) {

    $id = strip_tags($_POST['idBox']);

    $note = floatval($_POST['rate']);

    $id_user = $_SESSION['user'];

    $existingNotes = Notation::where('id_photo','=',$id)->first();


    $old_total_note = $existingNotes ->total_rating;
    $total_votants = $existingNotes->total_rates;
    $oldid_users = $existingNotes->id_users;



    $current_note  = $old_total_note + $note;
    $new_total_votants = $total_votants + 1;
    $new_note = $current_note / $new_total_votants;
    //update
    $new_users = $oldid_users.",".$id_user;

    $existingNotes->id_photo= $id;
    $existingNotes->rating = $new_note;
    $existingNotes->total_rates = $new_total_votants;
    $existingNotes->total_rating = $current_note;
    $existingNotes->id_users = $new_users ;

    $existingNotes->update();

}

v::with('App\\Validation\\Rules\\');
require __DIR__.'/../app/routes.php';