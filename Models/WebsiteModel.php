<?php

namespace App\Models;

class WebsiteModel extends Model
{
    protected $id;
    protected $name;
    protected $value;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }

    public function __construct()
    {
        //$this->table = "users";
        $class = str_replace(__NAMESPACE__.'\\', '', __CLASS__);
        $this->table = strtolower(str_replace('Model', '', $class));
        $this->table = "settings";
    }
    public function findOneByName($name)
    {
        return $this->customQuery("SELECT * FROM {$this->table} WHERE name = ?", [$name])->fetch();
    }

    public function getValueByName($array, $name) {
        foreach ($array as $item) {
            if ($item->name === $name) {
                return $item->value;
            }
        }
        return null; // Retourner null si le nom n'est pas trouvé
    }
}

