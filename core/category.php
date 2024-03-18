<?php

class Category
{
    //db stuff
    private $conn;
    private $table = 'categories';

    //post property
    public $id;
    public $name;
    public $created_at;


    //constructor with db connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
    //getting post from our database
    public function read()
    {
        //create query
        $query = 'SELECT 
        * FROM '.$this->table.'';

        //prepare statement
        $stmt = $this->conn->prepare($query);
        //execute query
        $stmt->execute();
        return $stmt;
    }

}
