<?php
namespace App\Models;

class Model
{
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
     * @return Model
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }


    /**
     * @return array
     * @doc https://stackoverflow.com/questions/4345554/convert-php-object-to-associative-array
     */
    public function toArray()
    {
        $result = array();
        foreach ($this as $key => $value) {
            $result[$key] = $value;
        }
        return $result;
    }

}