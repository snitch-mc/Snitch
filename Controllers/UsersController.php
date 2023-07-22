<?php
namespace App\Controllers;

use App\Models\UsersModel;

class UsersController extends Controller
{
    public function register()
    {
        $error = false;

        //On contrôle que le formulaire n'est pas vide
        if(!empty($_POST)){
            foreach ($_POST as $field => $value){
                if(empty($value)){
                    $error = true;
                    $_SESSION["errorMessage"] = "Merci de remplir $field.";
                    break;
                }
            }

            // On vérifie que l'email en est un
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) && !$error){
                $_SESSION["errorMessage"] = "Merci de mettre une adresse mail valide.";
                $error = true;
            }

            //On vérifie que les mots de passe correspondent
            if ($_POST["password"] != $_POST["confirmpassword"]) {
                $_SESSION["errorMessage"] = "Les deux mots de passe ne correspondent pas.";
                $error = true;
            }

            /////////////////////////////////////////////
            /// ICI ON FAIT LES CONTRÔLES DE SECURITE ///
            /////////////////////////////////////////////

            //Ici, on a des données valides
            if (!$error){

                //On nettoie les données
                $email = strip_tags($_POST["email"]);
                $username = strip_tags($_POST["username"]);

                //On chiffre le mot de passe
                $password = password_hash($_POST["password"], PASSWORD_ARGON2ID);

                //On stocke les données
                //On instancie le modèle concerné
                $user = new UsersModel();

                $user->setEmail($email)
                    ->setUsername($username)
                    ->setPassword($password);
                $user->create($user);


                $_SESSION["alreadyLogged"] = true;
                $_SESSION["successMessage"] = "Ton compte a bien été créé, tu peux maintenant te connecter.";
                header("Location: /users/login");
                exit();
            }
        }

        $this->render('users/register');
    }

    public function login()
    {

        $error = false;

        //On contrôle que le formulaire n'est pas vide
        if(!empty($_POST)){
            foreach ($_POST as $field => $value){
                if(empty($value)){
                    $_SESSION["errorMessage"] = "Merci de remplir $field.";
                    $error = true;
                    break;
                }
            }

            // On vérifie que l'email en est un
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) && !$error){
                $_SESSION["errorMessage"] = "Merci de mettre une adresse mail valide.";
                $error = true;
            }

            /////////////////////////////////////////////
            /// ICI ON FAIT LES CONTRÔLES DE SECURITE ///
            /////////////////////////////////////////////

            $userModel = new UsersModel();
            $user = $userModel->findOneByMail($_POST["email"]);


            //Ici, on a pas d'utilisateur
            if (!$user){
                $_SESSION["errorMessage"] = "Informations de connexion incorrectes.";
            } else {
                //Ici on a un user qui peut se connecter
                $user = $userModel->hydrate($user);
                if(password_verify($_POST["password"], $user->getPassword())){
                    $_SESSION["user"] = [
                        "id" => $user->getId(),
                        "username" => $user->getUsername(),
                        "email" => $user->getEmail(),
                        "permissions" => $user->getPermissions()
                    ];
                    $_SESSION["alreadyLogged"] = true;
                    header("Location: /users/profile");
                    exit();
                }
            }

        }

        $this->render('users/login');
    }

    public function profile()
    {
        unset($_SESSION["errorMessage"]);
        unset($_SESSION["successMessage"]);
        $error = false;


        //On ceck si l'utilisateur est connecté, si oui on charge la page et ses informations
        if (isset($_SESSION["user"])){
            $userModel = new UsersModel();
            //On va chercher l'utilisateur dans la base de donnée
            $user = $userModel->findOneByID($_SESSION["user"]["id"]);

            //On check si le username est défini
            if (isset($_POST["username"])){
                //On check s'il tente de changer le nom d'utilisateur
                if ($_POST["username"] != $_SESSION["user"]["username"] && !empty($_POST["username"])){
                    if (strlen($_POST["username"]) < 3){
                        $error = true;
                        $_SESSION["errorMessage"] = "Ce nom d'utilisateur est trop court. Minimum 3 caractères.";
                    } else if (strlen($_POST["username"]) > 16){
                        $error = true;
                        $_SESSION["errorMessage"] = "Ce nom d'utilisateur est trop long. Maximum 16 caractères.";
                    } else {
                        //Je save les données en protégeant contre les failles
                        $username = strip_tags($_POST["username"]);
                    }
                }

            //On check si le mail est défini
            if (isset($_POST["email"])){
                //On check s'il tente de changer le mail
                if ($_POST["email"] != $_SESSION["user"]["email"] && !empty($_POST["email"])){
                    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
                        $error = true;
                        $_SESSION["errorMessage"] = "Merci d'entrer une adresse mail valide.";
                    } else {
                        //Je save les données en protégeant contre les failles
                        $email = strip_tags($_POST["email"]);
                    }
                }
            }

            //On check s'il veut changer de mot de passe
            if (!empty($_POST["password"])){
                //L'utilisateur a inscrit un premier password, on check s'il correspond au deuxième password
                if ($_POST["password"] != $_POST["password-confirm"]){
                    $error = true;
                    $_SESSION["errorMessage"] = "Les deux mots de passe ne correspondent pas.";
                } else {
                    $password = password_hash($_POST["password"], PASSWORD_ARGON2ID);
                }
            }

            //On push ce qui a été changé dans la base de données et dans la session pour mettre à jour directement au rechargement de la page
                //On check si il n'y a pas d'erreur et s'il y a au moins un changement, sinon ça sert à rien de redéfinir
            if (empty($error) && isset($username) || isset($email) || isset($password)){

                //On instancie notre modèle
                $userUpdated = new UsersModel();

                //On hydrate sans oublier l'id de l'utilisateur
                $userUpdated->setId($_SESSION["user"]["id"]);
                if (isset($username)){
                    $userUpdated->setUsername($username);
                    //On met à jour la session
                    $_SESSION["user"]["username"] = $username;
                }
                if (isset($email)){
                    $userUpdated->setEmail($email);
                    //On met à jour la session aussi
                    $_SESSION["user"]["email"] = $email;
                }
                if (isset($password)){
                    $userUpdated->setPassword($password);
                }
                $_SESSION["successMessage"] = "Les données ont été modifiées avec succès.";
                //On update l'utilisateur dans la DB
                $userUpdated->update($_SESSION["user"]["id"]);


            }





            }

            $this->render('users/profile');
        } else {
            header("Location: /");
        }

    }

    public function logout()
    {
        unset($_SESSION["errorMessage"]);
        unset($_SESSION["user"]);
        header("Location: " . $_SERVER["HTTP_REFERER"]); //Permet de rediriger sur la page d'où venait l'utilisateur
        exit();
    }

    public function clearmsg()
    {
        unset($_SESSION["errorMessage"]);
        unset($_SESSION["user"]);
        exit();
    }
}
