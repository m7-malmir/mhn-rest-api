<?php

class Post{
    //db stuff
    private $conn;
    private $table='posts';

    //post property
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $create_at;

    //constructor with db connection
    public function __construct($db){
        $this->conn=$db;
    }
    //getting post from our database
    public function read(){
        //create query
        $query='SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at FROM posts p LEFT JOIN categories c ON p.category_id =c.id ORDER BY p.created_at DESC';
        
        //prepare statement
        $stmt =$this->conn->prepare($query);
        //execute query
        $stmt->execute();
        return $stmt;
    }
     public function read_single(){
        $query='SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at FROM posts p LEFT JOIN categories c ON p.category_id =c.id WHERE p.id =? LIMIT 1';
        
        //prepare statement
        $stmt =$this->conn->prepare($query);
        $stmt->bindParam(1,$this->id);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        $this->title=$row['title'];
        $this->body=$row['body'];
        $this->author=$row['author'];
        $this->category_id=$row['category_id'];
        $this->category_name=$row['category_name'];
     }
     public function create(){
        //create query
        $query='INSERT INTO '. $this->table.' SET title= :title, body = :body, author= :author, category_id= :category_id';
        //prapare statement
        $stmt=$this->conn->prepare($query);
        //clean data
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->body=htmlspecialchars(strip_tags($this->body));
        $this->author=htmlspecialchars(strip_tags($this->author));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
        //binding parameters
        $stmt->bindParam(':title',$this->title);
        $stmt->bindParam(':body',$this->body);
        $stmt->bindParam(':author',$this->author);
        $stmt->bindParam(':category_id',$this->category_id);

        //ecexute query
        if($stmt->execute()){
            return true;
        }
        printf("Error %s. \n",$stmt->error);
        return false;
    }
    public function update(){
        //update query
        $query='UPDATE '. $this->table.' SET title= :title, body = :body, author= :author, category_id= :category_id
        WHERE id=:id
        ';
        //prapare statement
        $stmt=$this->conn->prepare($query);
        //clean data
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->body=htmlspecialchars(strip_tags($this->body));
        $this->author=htmlspecialchars(strip_tags($this->author));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
        $this->id=htmlspecialchars(strip_tags($this->id));
        //binding parameters
        $stmt->bindParam(':title',$this->title);
        $stmt->bindParam(':body',$this->body);
        $stmt->bindParam(':author',$this->author);
        $stmt->bindParam(':category_id',$this->category_id);
        $stmt->bindParam(':id',$this->id);

        //ecexute query
        if($stmt->execute()){
            return true;
        }
        printf("Error %s. \n",$stmt->error);
        return false;
    }
    public function delete(){
        //create query
        $query='DELETE FROM '.$this->table.' WHERE id = :id';
        //prepare statment
        $stmt=$this->conn->prepare($query);
        //clean the data
        $this->id=htmlspecialchars(strip_tags($this->id));
        //binding the id param
        $stmt->bindParam(':id',$this->id);
        if($stmt->execute()){
            return true;
        }
        printf("Error %s. \n",$stmt->error);
        return false;
    }
}