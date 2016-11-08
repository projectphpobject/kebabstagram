<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;




$app->post('/rating','KebabController:ratingPhoto')->setName("rating");
$app->get('/', 'KebabController:liste')->setName('home');
$app->get('/kebab/:{id}', 'KebabController:afficher')->setName('afficher_kebab');
$app->get('/SearchTag/:{tag}','KebabController:rechercherTags')->setName('selection_kebabTags');
$app->get('/search', 'KebabController:byGets')->setName('search');

$app->group('', function(){
    $this->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
    $this->post('/auth/signup', 'AuthController:postSignUp');

    $this->get('/auth/signin', 'AuthController:getSignIn')->setName('auth.signin');
    $this->post('/auth/signin', 'AuthController:postSignIn');

})->add(new GuestMiddleware($container));




$app->group('', function(){

    $this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');
    $this->get('/auth/password/change', 'PasswordController:getChangePassword')->setName('auth.password.change');
    $this->post('/auth/password/change', 'PasswordController:postChangePassword');
    $this->get('/kebabs/', 'KebabController:display_userKebab')->setName('user_kebabs');

    $this->get('/kebab/add', 'KebabController:ajouter_kebab')->setName('ajouter_kebab');
    $this->post("/kebab",'KebabController:ajouter')->setName("save_kebab");


    $this->get('/commentaire/ajouter/:{id}','KebabController:ajouter_formulaire_comment')->setName("ajouter_commentaire");
    $this->post("/commentaire",'KebabController:ajoutCommentaires')->setName("save_commentaire");

    $this->get('/hashtags/ajouter/:{id}','KebabController:ajouter_formulaire_tag')->setName("ajouter_tags");
    $this->post("/tag",'KebabController:ajouterTag')->setName("save_tags");
    //rating photos


//  add other routes wich need that user signed in
})->add(new AuthMiddleware($container));