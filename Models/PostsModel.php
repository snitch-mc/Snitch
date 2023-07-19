<?php
namespace App\Models;

class PostsModel extends Model
{
    protected $id;
    protected $comportement;
    protected $vol;
    protected $grief;
    protected $xray;
    protected $triche;
    protected $informations;
    protected $user_id;
    protected $reported_user_uuid;
    protected $created_at;

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
    public function getComportement()
    {
        return $this->comportement;
    }

    /**
     * @param mixed $comportement
     */
    public function setComportement($comportement): void
    {
        $this->comportement = $comportement;
    }

    /**
     * @return mixed
     */
    public function getVol()
    {
        return $this->vol;
    }

    /**
     * @param mixed $vol
     */
    public function setVol($vol): void
    {
        $this->vol = $vol;
    }

    /**
     * @return mixed
     */
    public function getGrief()
    {
        return $this->grief;
    }

    /**
     * @param mixed $grief
     */
    public function setGrief($grief): void
    {
        $this->grief = $grief;
    }

    /**
     * @return mixed
     */
    public function getXray()
    {
        return $this->xray;
    }

    /**
     * @param mixed $xray
     */
    public function setXray($xray): void
    {
        $this->xray = $xray;
    }

    /**
     * @return mixed
     */
    public function getTriche()
    {
        return $this->triche;
    }

    /**
     * @param mixed $triche
     */
    public function setTriche($triche): void
    {
        $this->triche = $triche;
    }

    /**
     * @return mixed
     */
    public function getInformations()
    {
        return $this->informations;
    }

    /**
     * @param mixed $informations
     */
    public function setInformations($informations): void
    {
        $this->informations = $informations;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getReportedUserUuid()
    {
        return $this->reported_user_uuid;
    }

    /**
     * @param mixed $reported_user_uuid
     */
    public function setReportedUserUuid($reported_user_uuid): void
    {
        $this->reported_user_uuid = $reported_user_uuid;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }



    public function __construct()
    {
        //$this->table = "posts";
        $class = str_replace(__NAMESPACE__.'\\', '', __CLASS__);
        $this->table = strtolower(str_replace('Model', '', $class));
    }
}
