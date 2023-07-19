<?php
namespace App\Models;
use App\Core\Db;

class Model extends Db
{
    //Table de la base de donnée (pour les classes qui hériteront,
    // permet de définir le nom de la table)
    protected $table;

    //Instance de Db (permet d'accéder à la connexion à la BDD)
    private $db;

    //Méthode pour trouver toutes les données d'une table
    public function findAll()
    {
        $req = $this->customQuery('SELECT * FROM ' . $this->table);
        return $req->fetchAll();
    }

    //Méthode pour trouver une donnée selon des filtres
    public function findBy(array $filter)
    {
        $fields = [];
        $values = [];

        //On boucle pour éclater le tableau de filtre
        foreach ($filter as $field => $value) {
            $fields[] = "$field = ?";
            $values[] = "$value";
        }
        //On transforme le tableau fields en chaîne de caractère
        $list_fields = implode(' AND ', $fields);
        //On execute la requête
        return $this->customQuery("SELECT * FROM {$this->table} WHERE {$list_fields}", $values)->fetchAll();
    }

    public function findById(int $id)
    {
        return $this->customQuery("SELECT * FROM {$this->table} WHERE id = $id")->fetch();
    }

    //Méthode pour enregistrer une donnée dans la BDD
    public function create(Model $model)
    {
        $fields = [];
        $splits = [];
        $values = [];

        //On boucle pour éclater le tableau
        foreach ($model as $field => $value) {
            //1: INSERT INTO posts (les champs) VALUES (?, ?, ?...)
            if ($value !== null && $field !== "db" && $field !== "table") {
                $fields[] = $field;
                $splits[] = "?";
                $values[] = $value;
            }
        }
        //On transforme le tableau fields en chaîne de caractères
        $list_fields = implode(', ', $fields);
        $list_splits = implode(', ', $splits);

        //On exécute la requête
        return $this->customQuery("INSERT INTO {$this->table} ({$list_fields}) VALUES ({$list_splits})", $values);
    }

    //Méthode pour hydrater un modèle avec des données provenant d'un formulaire
    public function hydrate($data)
    {
        foreach ($data as $key => $value) {
            //On récupère le nom du setter correspondant à la clé
            //title = setTitle par exemple
            $setter = "set".ucfirst($key);

            //On vérifie que le setter existe
            if(method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
        return $this;
    }

    public function update(int $id)
    {
        $fields = [];
        $values = [];

        //On boucle pour éclater le tableau de filtre
        foreach ($this as $field => $value){
            //UPDATE posts SET 'title' = ? WHERE id = ?
            if ($value !== null && $field != "db" && $field != "table") {
                $fields[] = "$field = ?";
                $values[] = $value;
            }
        }
        $values[] = $id;
        //On transforme le tableau fields en chaine de caractères
        $list_fields = implode(', ', $fields);

        //On exécute la requête
        return $this->customQuery("UPDATE {$this->table} SET {$list_fields} WHERE id = ?", $values);
    }

    //Méthode pour supprimer un donnée de la BDD
    public function delete($id)
    {
        return $this->customQuery("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }



    //Méthode pour automatiser les requêtes (préparée ou non)
    public function customQuery(string $sql, array $param = null)
    {
        //On se connecte à la BDD
        $this->db = self::getInstance();

        //On vérifie si on a des paramètres
        if ($param !== null){
            //Ici j'ai des paramètres (requête préparée)
            $req = $this->db->prepare($sql);
            $req->execute($param);
            return $req;
        } else{
            //Ici on a une requête simple
            return $this->db->query($sql);
        }
    }
}
