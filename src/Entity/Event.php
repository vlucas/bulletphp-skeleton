<?php
namespace Entity;

class Event
{
    public $id;
    public $name;
    public $date_start;
    public $date_end;
    public $description;
    public $date_created;
    public $date_modified;

    public function __construct(array $data = array())
    {
        foreach($data as $field => $value) {
            if(isset($this->$field)) {
                $this->$field = $value;
            }
        }
    }

    public function save()
    {
        throw new \Exception("This is just a demo, and doesn't actually do anything, you know...");
    }

    /**
     * Array output for json_encode
     */
    public function toArray()
    {
        return get_object_vars($this);
    }
}
