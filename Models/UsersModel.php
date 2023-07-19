<?php
namespace App\Models;

class UsersModel extends Model
{
    protected $id;
    protected $username;
    protected $email;
    protected $password;
    protected $permissions;

    /**
     * @return mixed
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * @param mixed $permissions
     */
    public function setPermissions($permissions): void
    {
        $this->permissions = $permissions;
    }

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
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
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
    public function setUsername($username): self
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): self
    {
        $this->password = $password;
        return $this;
    }

    public function __construct()
    {
        //$this->table = "users";
        $class = str_replace(__NAMESPACE__.'\\', '', __CLASS__);
        $this->table = strtolower(str_replace('Model', '', $class));
    }

    //Récupère un utilisateur avec son email
    public function findOneByMail($email)
    {
        return $this->customQuery("SELECT * FROM {$this->table} WHERE email = ?", [$email])->fetch();
    }

    public function findOneByID($id)
    {
        return $this->customQuery("SELECT * FROM {$this->table} WHERE id = ?", [$id])->fetch();
    }














}
