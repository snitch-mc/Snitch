<?php
namespace App\Controllers;

use App\Models\PostsModel;
use App\Models\ReportedModel;
use App\Models\UsersModel;

class PostsController extends Controller
{
    public function index()
    {
        //On vérifie si l'utilisateur est connecté
        if (!isset($_SESSION["user"])){
            header("Location: /users/login");
            exit();
        }
        //On instancie le modèle correspondant à la table "posts"
        $postsModel = new PostsModel();

        //On va chercher tous les posts par ordre du plus récent au plus ancien
        $posts = $postsModel->findAllDESC();

        $this->render('posts/index', $posts);
    }

    public function more($id)
    {
        //On instancie le modèle correspondant à la table dans notre BDD
        $postsModel = new PostsModel();
        $userModel = new UsersModel();
        $reportedUserModel = new ReportedModel();

        //On récupère le post dans notre BDD
        $post = $postsModel->findById($id);
        $reportedBy = $userModel->findOneByID($post->user_id);
        $reportedUser = $reportedUserModel->findOneByUUID($post->reported_user_uuid);

        //On affiche la vue en lui envoyant le post
        $this->render('posts/more', compact('post', 'reportedBy', 'reportedUser'));
    }


    //Méthode pour ajouter un post
    public function add()
    {

        $error = false;
        unset($_SESSION["errorMessage"]);

        //On vérifie si l'utilisateur est connecté
        if (!isset($_SESSION["user"])){
            header("Location: /users/login");
            exit();
        }

        //On vérifie si l'utilisateur a la permission
        if ($_SESSION["user"]["permissions"] > 2){
            $_SESSION["errorMessage"] = "Tu n'as pas la permission de signaler des joueurs. Tu dois être gérant de serveur au minimum.";
            header("Location: /");
            exit();
        }

        //Ici l'utilisateur est connecté
        //on peut traiter le formulaire
        if (!empty($_POST)){

            foreach ($_POST as $field => $value){
                if (empty($value)){
                    $_SESSION["errorMessage"] = "Merci de remplir le champ $field";
                    $error = true;
                }
            }

            if (!empty($_POST["minecraftuuid"])){
                //Je check s'il s'agit bien d'un UUID Minecraft
                $uuid = $_POST["minecraftuuid"];
                if (!preg_match('/^[A-F\d]{8}-[A-F\d]{4}-4[A-F\d]{3}-[89AB][A-F\d]{3}-[A-F\d]{12}$/i', $uuid)){
                    $_SESSION["errorMessage"] = "Merci de fournir un UUID valide tel qu'affiché dans la box. Si vous ne trouvez pas, utilisez la fonction FIND UUID.";
                    $error = true;
                }
            }


            if (!empty($_POST["minecraft"])){
                //Je check s'il s'agit bien d'un username minecraft
                $username = $_POST["minecraft"];
                if (!preg_match("/^[a-zA-Z0-9_]{2,16}$/", $username)){
                    $_SESSION["errorMessage"] = "Merci de fournir un pseudo minecraft valide.";
                    $error = true;
                }
            }

            //Si je n'ai pas d'erreur on peut enregistrer le post
            if (!$error) {
                //Je protège les données contre les failles
                $informations = strip_tags($_POST["description"]);
                $username = strip_tags($_POST["minecraft"]);

                //On instancie nos modèles
                $postModel = new PostsModel();
                $reportedModel = new ReportedModel();
                //On hydrate notre premier modèle
                $postModel->setReportedUserUuid($uuid);
                $postModel->setInformations($informations);
                $postModel->setUserId($_SESSION["user"]["id"]);

                //On check les raisons et si elles sont définies, on hydrate le boolean 1
                if ($_POST["comportement"] === "on"){
                    $postModel->setComportement(1);
                }
                if ($_POST["vol"] === "on"){
                    $postModel->setVol(1);
                }
                if ($_POST["grief"] === "on"){
                    $postModel->setGrief(1);
                }
                if ($_POST["xray"] === "on"){
                    $postModel->setXray(1);
                }
                if ($_POST["triche"] === "on"){
                    $postModel->setTriche(1);
                }

                $postModel->create($postModel);

                //On s'occupe d'ajouter l'utilisateur reporté dans la DB

                //Ici on check si l'utilisateur a déjà été report
                $reported = $reportedModel->findOneByUUID($uuid);

                if ($reported) {
                    //Ici l'utilisateur à déjà été report, donc on met à jour tout simplement
                    $reportedModel->setUsername($username);
                    $reportedModel->setId($reported->id);
                    $reportedModel->update($reported->id);
                } else {
                    //Ici l'utilisateur est nouveau donc on créé une nouvelle entrée dans la base de donnée
                    $reportedModel->setUuid($uuid);
                    $reportedModel->setUsername($username);
                    $reportedModel->create($reportedModel);
                }

                //On redirige avec un message
                $_SESSION["successMessage"] = "Votre post a bien été enregistré, bravo.";
                header("Location: /posts");
                exit();
            }

            //Ici j'ai des erreurs dans je remplis la partie erreur de ma session
            $_SESSION["errors"] = $error;
        }

        $this->render('posts/add');
    }

    public function updatePost($id)
    {
        //On vérifie si l'utilisateur a le droit de modifier le post
        if (!isset($_SESSION["user"]) && !empty($_SESSION["user"]["id"])) {
            header("Location: /posts");
            exit();
        }

        $postModel = new PostsModel();
        $reportedUserModel = new ReportedModel();

        $post = $postModel->findById($id);
        $reported = $reportedUserModel->findOneByUUID($post->reported_user_uuid);

        if (!$post) {
            header("Location: /posts");
            exit();
        }

        //Ici le post existe dans la BDD
        if ($post->user_id !== $_SESSION["user"]["id"]) {
            header("Location: /posts");
            exit();
        }

        //ICI on peut modifier le post
        //On traite notre formulaire
        if (!empty($_POST)) {
            $error = false;


            foreach ($_POST as $field => $value) {
                if (empty($value)) {
                    $error = true;
                    $_SESSION["errorMessage"] = "Merci de remplir le champ $field";
                }
            }
            ///////////////////////////////////
            //TOUTES AUTRES VERIFICATIONS ICI//
            ///////////////////////////////////


            //Si je n'ai pas d'erreur, on peut enregistrer le post
            if (!$error) {
                //Je protège les données contre les failles
                $informations = strip_tags($_POST["description"]);

                //On instancie notre modèle
                $postUpdated = new PostsModel();

                //On check les raisons et si elles sont définies, on hydrate le boolean 1, sinon en false, 0
                if ($_POST["comportement"] === "on"){
                    $postUpdated->setComportement(1);
                } else {
                    $postUpdated->setComportement(0);
                }
                if ($_POST["vol"] === "on"){
                    $postUpdated->setVol(1);
                } else {
                    $postUpdated->setVol(0);
                }
                if ($_POST["grief"] === "on"){
                    $postUpdated->setGrief(1);
                } else {
                    $postUpdated->setGrief(0);
                }
                if ($_POST["xray"] === "on"){
                    $postUpdated->setXray(1);
                } else {
                    $postUpdated->setXray(0);
                }
                if ($_POST["triche"] === "on"){
                    $postUpdated->setTriche(1);
                } else {
                    $postUpdated->setTriche(0);
                }

                //On hydrate sans oublier l'id du post
                $postUpdated->setId($post->id);
                $postUpdated->setInformations($informations);
                //On update le post
                $postUpdated->update($post->id);
                
                //On redirige avec un message
                    $_SESSION["successMessage"] = "Votre post a bien été modifié, bravo utilisateur";
                    header("Location: /posts/more/$post->id");
                    exit();
                }
            
            //Ici, j'ai des erreurs, donc je crée ma session avec erreur
            $_SESSION["error"] = $error;
        }
        
        $this->render("posts/updatePost", [$post, $reported]);
    }

    public function deletePost($id){
        if (!isset($_SESSION["user"]) && !empty($_SESSION["user"]["id"])){
            header("Location: /posts");
            exit();
        }

        $postModel = new PostsModel();
        $post = $postModel->findById($id);

        if(!$post){
            http_response_code(404);
            header("Location: /posts");
            exit();
        }

        if($post->user_id !== $_SESSION["user"]["id"]){
            header("Location: /posts");
            exit();
        }

        //Ici on a le droit de supprimer le post
        $postModel->delete($post->id);
        //On informe l'utilisateur que le post a bien été supprimé
        $_SESSION["successMessagemessage"] = "Le post '$post->id' a bien été supprimé";
        //On redirige l'utilisateur
        header("Location: /posts");

    }

    //Logique pour afficher uniquement le début du contenu du post
    public static function shortContent(string $content, int $limit = 100)
    {
        // Si la longueur du texte est plus petite ou égale à la limite, on ne fait rien
        if (strlen($content) <= $limit) {
            return $content;
        }

        // On cherche le premier espace après la limite
        $lastSpace = strpos($content, ' ', $limit);

        // Si pas d'espace trouvé après la limite, on coupe le texte à la limite
        if ($lastSpace === false) {
            return substr($content, 0, $limit) . "...";
        }

        // On retourne la phrase coupée au bon endroit et on met "..."
        return substr($content, 0, $lastSpace) . "...";
    }


}
