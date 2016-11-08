<?php


namespace  App\Controllers;
use App\Models\Departement;
class Controller {

    protected  $container;

    public function __construct($container)
    {
        $this->container = $container;
    }


    public function  __get($property)
    {

        if($this->container->{$property}) {

            return $this->container->{$property};
        }

    }

    public function variables_menu()
    {
        $this->view->getEnvironment()->addGlobal('menu', [
            array("name"=>"Liste des kebabs", "href"=> $this->router->pathFor('home')),


            array("name"=>"Mes kebabs", "href" => $this->router->pathFor('user_kebabs')),

            array("name"=>"Ajouter Kebab", "href"=> $this->router->pathFor('ajouter_kebab')),

            array("name"=>"Membres", "href"=> $this->router->pathFor('home')),

            array("name"=>"Inscription", "href"=> $this->router->pathFor('auth.signup'))


        ]);



    }


      public function variables_searchbar()
      {

          $this->view->getEnvironment()->addGlobal('searchbar', [
              "action"      =>     $this->router->pathFor("search"),
              "departements" =>     Departement::orderBy("nom")->get()

          ]);

      }


}