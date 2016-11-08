<?php

namespace  App\Controllers;


use App\Models\Photo;
use App\Models\User;
use App\Models\Commentaires;
use App\Models\Notation;
use App\Models\Tags;
use App\Slim;

use App\Controllers\Controller;
use App\Auth\Auth as u;


class KebabController extends Controller {






    public function byGets($request,$response)
    {
        $this->variables_menu();
        $this->variables_searchbar();
        $preremp = array();

        $gets = $request->getParams();

        $urltags = Tags::all();
        $ratings = Notation::orderBy('id_photo')->get();
        $all_users= array();
        if ($ratings!= null) {

            foreach ($ratings as $key => $value) {

                $all_users[$key] = explode(',',$value->id_users);
            }

        }
        $taille = count($all_users);
        //print_r($all_users);die();
        $users=User::all();
        $commentaires=Commentaires::orderBy("date", "desc")->get();
        $photos = Photo::orderBy("created_at", "desc")->with('commentaires');

        if ($gets["title"] != "") {
            $preremp['nom'] = $gets['title'];
            $photos->where(function($q) use ($gets) {
                $q->where("titre", "like", "%" . $gets["title"] . "%");
                $q->orwhere("description", "like", "%" . $gets["title"] . "%");

            });
            $photos = $photos->get();

        }
        elseif ($gets["tag"] != "" && $gets["categorie"] == "tag") {
            $tag= trim($gets["tag"] ,"#");
            $preremp['tag'] = $gets['tag'];
           return  $this->rechercherTags($request,$response,$tag,1);

        }
        elseif ( $gets["tag"] !="" && $gets["categorie"] =="user") {
            return $this->display_userKebab($request,$response,($gets["tag"]));

        }
        elseif ( $gets["tag"] !="" && $gets["categorie"] =="mot") {
            $preremp['tag'] = $gets['tag'];
            $photos->where(function($q) use ($gets) {
                $q->where("titre", "like", "%" . $gets["tag"] . "%");
                $q->orwhere("description", "like", "%" . $gets["tag"] . "%");
            });
            $photos = $photos->get();
        }
        elseif ($gets["ville"] != "") {
            $preremp['ville'] = $gets['ville'];
            $photos->where("endroit", "like", "%".$gets["ville"]."%");
            $photos = $photos->get();
        }


        $links = array();
        $links_photos = array();


        foreach ($photos as $key => $value)
        {
            $links[$value->id] = $this->router->pathFor("afficher_kebab", array("id"=>$value->id) );
        }

        global $config;
        foreach ($photos as $key => $a)
        {
            $links[$a->id] = $this->router->pathFor("afficher_kebab", array("id"=>$a->id) );


                $links_photos[$a->id] = $config['upload_dir']."/".$a->id."/".$a->id.".".$a->extension;



        }

        $count=array();
        foreach ($photos as $key => $a)
        {

            $links_com[$a->id] = $this->router->pathFor("ajouter_commentaire", array("id"=>$a->id) );
            $links_tags[$a->id] = $this->router->pathFor("ajouter_tags", array("id"=>$a->id) );
            $count[$a->id]=Commentaires::where('id_photo','=',$a->id)->count();
        }
        if (sizeof($photos) < 1 ) {
            $this->view->render($response,'error.html.twig', [

                "preremp"=>$preremp,
                "title_error" => "Aucun résulat",
                "description" => "Il n'y a pas de kebabs disponibles"
            ]);
        } else {
            $this->view->render($response,'liste_kebabs.html.twig', [

                 "title"        => 'Tous les kebabs',
                "photos"        => $photos,
                "users"         =>User::all(),
                "userratings"   => $all_users,
                "current_user"  => $_SESSION['user'],
                "links"         =>$links,
                "count"         =>$count,
                "taille"        => $taille,
                "commentaires"  =>$commentaires,
                "ratings"       =>$ratings,
                "links_com"     =>$links_com,
                "links_tags"    => $links_tags,
                "links_photos"  =>$links_photos,
                "urltag"        =>$urltags,
                "preremp"       =>$preremp,

            ] );
        }
    }


public function display_userKebab($request,$response,$utilisateur=null)
{
    $this->variables_menu();
    $this->variables_searchbar();
    $gets= $request->getParams();
    global $config;
     if($utilisateur) {

         $photos = Photo::whereHas('user', function ($query) use ($utilisateur){
             $query->where('nom', 'like', $utilisateur);
             $query->orwhere('prenom', 'like', $utilisateur);
         })->get();

      }
      else  {

               $photos = Photo::where('id_user', '=', $_SESSION['user'])->orderBy("created_at", "desc")->get();

           }

    $urltags = Tags::all();


    $commentaires=Commentaires::orderBy("date", "desc")->get();
    $links = array();
    $links_photos = array();
    $links_tags = array();



    if (sizeof($photos) < 1 ) {
         $this->view->render($response,'error.html.twig', [
            "title_error" => "Aucun kebab",
            "description" => "Il n'y a pas de kebabs disponibles dans la méthode display_userkebab"
        ]);


    } else {


        global $config;
        foreach ($photos as $key => $a)
        {

            $links[$a->id] = $this->router->pathFor('afficher_kebab',[ 'id' => $a->id ] );



            if($utilisateur == null ) {
                $links_photos[$a->id] = "../" . $config['upload_dir'] . "/" . $a->id . "/" . $a->id . "." . $a->extension;
            }
            else
                $links_photos[$a->id] =  $config['upload_dir'] . "/" . $a->id . "/" . $a->id . "." . $a->extension;


        }
        $count=array();
        foreach ($photos as $key => $a)
        {

            $links_com[$a->id] = $this->router->pathFor("ajouter_commentaire", array("id"=>$a->id) );
            $links_tags[$a->id] = $this->router->pathFor("ajouter_tags", array("id"=>$a->id) );
            $count[$a->id]=Commentaires::where('id_photo','=',$a->id)->count();
        }


        $this->view->render($response,'liste_kebabs.html.twig', [

            "title" => 'Tous les kebabs',
            "photos" => $photos,
            "users" =>User::all(),
            "links"=>$links,
            "count"=>$count,
            "commentaires"=>$commentaires,
            "links_com"=>$links_com,
            "links_tags" => $links_tags,
            "links_photos"=>$links_photos,
            "urltag"=>$urltags

        ]);

    }
    return $response;
}





public function ajoutCommentaires($request,$response)
{


    $posts = $request->getParams();

    try
    {

        if(isset($posts['valider']))
        {   // début
            $hash = "sha256";
            global $config;

            $posts =  $request->getParams();
            //$this->variables_menu();
            //$this->variables_searchbar();

            $c = new Commentaires();
            $u=User::where('pseudo', '=', strip_tags($posts['pseudo']))->first();
            $p=Photo::where('titre', '=', strip_tags($posts['titre']))->first();


            if($p== null | strip_tags($posts['message'])==null)
            {

                $this->view->render($response, 'error.html.twig',[
                    "title_error"=>"Erreur 404",
                    "description"=>"La photo demandée n'existe pas."
                ]);
            }
            $url = $this->convertHashtags($posts['message']);


            $tag= $this->getTag($posts['message']);
            $compteur =count($tag);

            if ($tag != null) {
                $i=0;
                while($i < $compteur) {

                       $t = new Tags();

                        $t->label = $tag[$i];
                        $t->id_photo = $p->id;
                        $t->save();
                    $i++;
                    }


            }
            $c->message=strip_tags($posts['message']);
            $c->id_user = $u->id;
            $c->id_photo =$p->id;
            $c->save();


            if(isset($_SESSION['commentaire']))
                unset($_SESSION['commentaire']);
            return  $response->withRedirect($this->router->pathFor('home'));
        }
        else
        {
            if(isset($_SESSION['commentaire']))
                unset($_SESSION['commentaire']);
            return  $response->withRedirect($this->router->pathFor('ajouter_commentaire'));
        }
    }
    catch(Exception $e)
    {

        $this->view->render($response, 'error.html.twig',[
            "title_error"=>"Erreur dans le formulaire",
            "description"=>$e->getMessage(),
        ]);
    }
}





public function ajouter($request, $response){

    $posts = $request->getParams();

    try
    {
        //Sauvegarder la photo
        if(isset($posts['valider']) )
        {
            $this->sauvegarder($request,$response);
            return  $response->withRedirect($this->router->pathFor('home'));
        }
        else
        {
            if(isset($_SESSION['photo']))
                unset($_SESSION['photo']);
            return  $response->withRedirect($this->router->pathFor('ajouter_kebab'));

        }
    }
    catch(Exception $e)
    {
        $this->view->render($response, 'error.html.twig',[
            "title_error"=>"Erreur dans le formulaire",
            "description"=>$e->getMessage(),
        ]);

    }
}

    public  function index($request, $response) {
        $this->flash->addMessage('global', 'Test flash message');
        return $this->view->render($response, 'home.twig');

    }

    public static function verifier_formulaire_photos($posts, $mdp = true)
    {

        if($mdp)
        {
            if(!isset($posts['mdp']) || empty($posts['mdp']))
                throw new \Exception("Il manque le mot de passe");

            if(strlen($posts['mdp']) < 6)
                throw new \Exception("Votre mot de passe est trop court");

            if($posts['mdp'] != $posts['confirm_mdp'])
                throw new \Exception("Les mots de passe ne correspondent pas");
        }

        if(!isset($posts['ville']) || empty($posts['ville']))
            throw new \Exception("Il manque la ville");

        if(!isset($posts['pseudo']) || empty($posts['pseudo']))
            throw new \Exception("Il manque votre pseudonyme");

        if(!isset($posts['mail']) || empty($posts['mail']))
            throw new \Exception("Il manque votre e-mail");

        if(!isset($posts['titre']) || empty($posts['titre']))
            throw new \Exception("Il manque un titre à votre kebab !");

        if(!isset($posts['description']))
            $posts['description'] = '';
    }


public function rechercherTags($request, $response,$tag,$search=null)
{
    $this->variables_menu();
    $this->variables_searchbar();
    $urltags = Tags::where('label', '=', $tag)->get();
    $photos = Photo::orderBy("created_at", "desc")->get();

    $ratings = Notation::orderBy('id_photo')->get();
    $all_users= array();
    if ($ratings!= null) {

        foreach ($ratings as $key => $value) {

            $all_users[$key] = explode(',',$value->id_users);
        }

    }
    $taille = count($all_users);
    $users=User::all();
    $commentaires=Commentaires::orderBy("date", "desc")->get();
    $links = array();
    $links_photos = array();
    $photos2=array();
    global $config;
    foreach ($photos as $key => $a) {

            foreach ($urltags as $item => $value) {
              if($value->id_photo == $a->id) {
                    $photos2[$key] = $photos[$key];
                    $links[$a->id] = $this->router->pathFor('afficher_kebab', ['id' => $a->id]);
                  if($search != null)
                    $links_photos[$a->id] = $config['upload_dir']. "/" . $a->id . "/" . $a->id . "." . $a->extension;
                  else $links_photos[$a->id] = "../".$config['upload_dir']. "/" . $a->id . "/" . $a->id . "." . $a->extension;
              }
            }
    }

    $grtags= [];
    $count=array();
    foreach ($photos2 as $key => $a)
    {
            foreach ($urltags as $item => $value) {
                    if($value->id_photo == $a->id) {
                        $links_com[$a->id] = $this->router->pathFor("ajouter_commentaire", array("id" => $a->id));
                        $links_tags[$a->id] = $this->router->pathFor("ajouter_tags", array("id"=>$a->id) );
                        $grtags[$a->id] = $this->router->pathFor("selection_kebabTags", array("tag" => $value->label));
                        $count[$a->id] = Commentaires::where('id_photo', '=', $a->id)->count();
                    }
            }
    }


    $this->view->render($response,'liste_kebabs_tags.html.twig', [

        "title" => 'Tous les kebabs',
        "photos" => $photos2,
        "users" =>User::all(),
        "links"=>$links,
        "userratings" =>  $all_users,
        "count"=>$count,
        "ratings"=>$ratings,
        "taille" => $taille,
        "commentaires"=>$commentaires,
        "links_com"=>$links_com,
        "links_tags" => $links_tags,
        "links_photos"=>$links_photos,
        "urltag"=>Tags::all()

    ]);

}

//rating photos


    public function ratingPhoto($request,$response)
    {
        $this->variables_menu();
        $this->variables_searchbar();
        $posts = $request->getParams();

        $this->view->render($response,'liste_kebabs_tags.html.twig', [

            "title" => 'Tous les kebabs',
            "posts" => $posts['idBox'],
            "urltag"=>Tags::all()

        ]);

    }

    public function liste($request, $response){

        $this->variables_menu();
        $this->variables_searchbar();

        $photos = Photo::orderBy("created_at", "desc")->get();
        $urltags = Tags::all();
        $ratings = Notation::orderBy('id_photo')->get();
        $all_users= array();
        if ($ratings!= null) {

            foreach ($ratings as $key => $value) {

                $all_users[$key] = explode(',',$value->id_users);
            }

        }
       $taille = count($all_users);

        $users=User::all();
        $commentaires=Commentaires::orderBy("date", "desc")->get();
        $links = array();
        $links_photos = array();
        $links_tags = array();



        if (sizeof($photos) < 1 ) {
            $tmp = $this->view->render($response,'error.html.twig', [
                     "title_error" => "Aucun kebab",
                     "description" => "Il n'y a pas de kebabs disponibles"
            ]);


        } else {


            global $config;
            foreach ($photos as $key => $a)
            {
                $links[$a->id] = $this->router->pathFor('afficher_kebab',[ 'id' => $a->id ] );
                $links_photos[$a->id] = "".$config['upload_dir']."/".$a->id."/".$a->id.".".$a->extension;
            }
            $count=array();
            foreach ($photos as $key => $a)
            {

                $links_com[$a->id] = $this->router->pathFor("ajouter_commentaire", array("id"=>$a->id) );
                $links_tags[$a->id] = $this->router->pathFor("ajouter_tags", array("id"=>$a->id) );
                $count[$a->id]=Commentaires::where('id_photo','=',$a->id)->count();
            }


             $this->view->render($response,'liste_kebabs.html.twig', [

                "title" => 'Tous les kebabs',
                "photos" => $photos,
                "users" =>User::all(),
                 "userratings" =>  $all_users,
                 "current_user" => $_SESSION['user'],
                "links"=>$links,
                "count"=>$count,
                 "taille" => $taille,
                "commentaires"=>$commentaires,
                "ratings"=>$ratings,
                "links_com"=>$links_com,
                 "links_tags" => $links_tags,
                "links_photos"=>$links_photos,
                "urltag"=>$urltags

            ]);

        }
        return $response;
    }



    //ajout des photos

    public function ajouter_kebab($request, $response)
    {
        $this->variables_menu();
        $this->variables_searchbar();
        $user=User::where('id','=',$_SESSION['user'])->first();
        $this->view->render($response, 'formulaire_kebab.html.twig',[
            "action"=>$this->router->pathFor("save_kebab"),
            "method"=>"post",
            "user"=> $user,
            "nom_form"=>"Déposer un kebab",
            "title"=>"Déposer un kebab"
        ]);

    }

    public function sauvegarder($request, $response)
    {
        $hash = "sha256";
        global $config;
        $posts =  $request->getParams();

        $p = new Photo();


        if(isset($_SESSION['photo']))
        {
            $p->titre = strip_tags($_SESSION['photo']['titre']);
            $p->description = strip_tags($_SESSION['photo']['description']);
            $p->endroit = strip_tags($_SESSION['photo']['endroit']);
            $p->id_user = $_SESSION['user'];
            $p->email = strip_tags($_SESSION['photo']['mail']);
            $p->password = hash($hash, $_SESSION['photo']['mdp']);

            $p->save();
        }
        else
        {
                $this->verifier_formulaire_photos($posts);
                $p->titre = strip_tags($posts['titre']);
                $p->description = strip_tags($posts['description']);
                $p->endroit = strip_tags($posts['ville']);
                $p->id_user = $_SESSION['user'];
            foreach ($_FILES['photos']['name'] as $key => $name)
            {
                    if(!empty($name))
                    {
                        $explode = explode(".",$name);
                        $extension = end($explode);

                        $chemin = $_FILES['photos']['tmp_name'][$key];
                        $destination = $config['upload_dir']."/";

                        if($extension == null)
                        {
                            $explode = explode(".", $chemin);
                            $p->extension = end($explode);
                        }
                        else
                            $p->extension = $extension;

                        $p->save();
                        $destination .= $p->id;

                        if(!file_exists($destination)) {
                            mkdir($destination, 0777, true);

                        }
                        $destination .= "/$p->id.$p->extension";


                        if(is_uploaded_file($chemin))
                            move_uploaded_file($chemin, $destination);
                        else
                            rename($chemin, $destination);
                    }


                }
        }

        if(isset($_SESSION['photo']))
            unset($_SESSION['photo']);

        $p->save();
        $n= new Notation();
        $n->id_photo =$p->id;
        $n->id_users = 0;
        $n->rating = 0;
        $n->total_rating = 0;
        $n->total_rates = 0;
        $n->save();
    }



    public function afficher($request, $response,$id)
    {

        $this->variables_menu();
        $this->variables_searchbar();
        $b=Photo::find($id)->first();
        $a = Photo::find($id);
        $c = Commentaires::all();

        if($a == null)
        {
            $this->view->render($response, 'error.html.twig',[
                "title_error"=>"Erreur 404",
                "description"=>"Vous essayez d'accéder à un kebab qui n'existe pas."
            ]);

        }
        else
        {
                $photos = $a;
                global $config;
                $liens_photos = array();
                foreach ($photos as $key=>$p)
                {
                    $liens_photos[]="".$config['upload_dir']."/".$p->id."/".$p->id.".".$p->extension;
                }

                $this->view->render($response, 'kebab.html.twig',[
                    "kebab"=>$b,
                    "user"=> User::find($b->id_user),
                    "utilisateurs" => User::all(),
                    "photos"=>$liens_photos,
                    "commentaires" => $c,
                    "title"=>$b->titre

                ]);
        }

    }

    public function ajouter_formulaire_comment($request, $response,$id)
    {
            global $config;


            $this->variables_menu();
            $this->variables_searchbar();
            $b = Photo::find($id)->first();
            $formulaire = $b->toArray();
            $token = $this->token();
            $formulaire['token'] = $token;
            $_SESSION['token'] = $token;
            $_SESSION['token_time'] = time();

            $this->view->render($response, 'photo_commentaires.html.twig',[
                "user"=>User::find($_SESSION['user']),
                "action"=>$this->router->pathFor("save_commentaire"),
                "method"=>"post",
                "nom_form"=>"Déposer un Commentaire",
                "title_photo" => $b->titre,
                "title"=>"Déposer un Commentaire",
                "form"=>$formulaire
            ]);


    }

    public function ajouter_formulaire_tag($request, $response,$id)
    {
            global $config;

            $this->variables_menu();
            $b = Photo::find($id)->first();
            $formulaire = $b->toArray();
            $token = $this->token();
            $formulaire['token'] = $token;
            $_SESSION['token'] = $token;
            $_SESSION['token_time'] = time();

            $this->view->render($response, 'kebabs_tags_formulaire.html.twig',[
                "user"=>User::find($_SESSION['user']),
                "action"=>$this->router->pathFor("save_tags"),
                "method"=>"post",
                "nom_form"=>"Créer un tag",
                "id"  => $b->id,
                "title_photo" => $b->titre,
                "title"=>"Creation d'un tag",
                "form"=>$formulaire
            ]);


    }


    public function ajouterTag($request,$response) {

        $posts = $request->getParams();
        $this->variables_menu();
        $this->variables_searchbar();
        $p=Photo::where('id', '=', strip_tags($posts['id']))->first();
        $id=$p->id;
        try
        {

            if(isset($posts['valider']))
            {   // début
                $hash = "sha256";
                global $config;
                $p=Photo::where('id', '=', strip_tags($posts['id']))->first();


                if($p== null | strip_tags($posts['tag'])==null)
                {

                    $this->view->render($response, 'error.html.twig',[
                        "title_error"=>"Erreur 404",
                        "description"=>"La photo demandée n'existe pas."
                    ]);
                }
                $url = $this->convertHashtags($posts['tag']);


                $tag= $this->getTag($posts['tag']);
                $compteur =count($tag);

                if ($tag != null) {
                    $i=0;
                    while($i < $compteur) {

                        $t = new Tags();

                        $t->label = $tag[$i];
                        $t->id_photo = $p->id;
                        $t->save();
                        $i++;
                    }


                }

                if(isset($_SESSION['tag']))
                    unset($_SESSION['tag']);

                return  $response->withRedirect($this->router->pathFor('home'));
            }

            else
            {
                if(isset($_SESSION['tag']))
                    unset($_SESSION['tag']);
                return  $response->withRedirect($this->router->pathFor('ajouter_tags',['id' => $p->id ]));
            }
        }
        catch(Exception $e)
        {

            $this->view->render($response, 'error.html.twig',[
                "title_error"=>"Erreur dans le formulaire",
                "description"=>$e->getMessage(),
            ]);
        }
    }


   //hashtags
    public function getTag($str) {
         $chaine = $str;
         $gr= [];
          //pour avoir le # il faut renvoyer gr[0] et si on veut sans le # on renvoit gr[1]
         preg_match_all('/#([^\s]+)/',$chaine,$gr);
         return $gr[1];
    }
    public function  convertHashtags($str) {

        $chaine = $str;
        $htag = "#";
        $tab = explode(" ", $chaine);
        $compteur = count($tab);

        $i=0;

        while($i < $compteur ) {

            if(substr($tab[$i], 0, 1) === $htag) {

              $param = $tab[$i];
              $param = preg_replace("#[^0-9a-z]#i","",$param);
              $tab[$i] = "<a href='{{ base_url() }}/hashtags?SearchTag=$param'>".$tab[$i]."</a>";
            }
         $i++;
        }

       $chaine = implode(" ", $tab);

        return $chaine;
    }




    private function token()
    {
        return hash("sha256", uniqid());
    }



    private function verifier_token($token)
    {

            if(isset($_SESSION['token']) && isset($_SESSION['token_time']))
            {
                if($_SESSION['token'] == $token)
                {
                    //expire au bout de 10min
                    if($_SESSION['token_time'] >= (time() - 10*60))
                        return true;
                    else
                        return false;
                }
                else

                    return false;
            }
            else
                return false;
    }


}