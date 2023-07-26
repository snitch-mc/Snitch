<?php
namespace App\Models;

class ReportedModel extends Model
{
    protected $uuid;
    protected $username;
    protected $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param mixed $uuid
     */
    public function setUuid($uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }




    public function __construct()
    {
        $class = str_replace(__NAMESPACE__.'\\', '', __CLASS__);
        $this->table = strtolower(str_replace('Model', '', $class));
        $this->table = "reported_users";
    }

    //Récupère un utilisateur avec son email
    public function findOneByUUID($uuid)
    {
        return $this->customQuery("SELECT * FROM {$this->table} WHERE uuid = ?", [$uuid])->fetch();
    }

    public function findOneByUsername($username)
    {
        return $this->customQuery("SELECT * FROM {$this->table} WHERE username = ?", [$username])->fetch();
    }

    public function findAllDESC()
    {
        $req = $this->customQuery('SELECT * FROM ' . $this->table . ' ORDER BY id DESC');
        return $req->fetchAll();
    }

    public function findReportedPlayer($username, $uuid)
    {
        $req = $this->customQuery('SELECT * FROM ' . $this->table . ' WHERE username LIKE ? OR uuid LIKE ?', [$username, $uuid]);
        return $req->fetchAll();
    }

}
