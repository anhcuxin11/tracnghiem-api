<?php

class Question{
    private $conn;

    //question properties
    public $id;
    public $title;
    public $a;
    public $b;
    public $c;
    public $d;
    public $result;

    //connect database
    public function __construct($db){
        $this->conn = $db;
    }

    //read data
    public function read(){
        $query = "SELECT * FROM cauhoi ORDER BY id LIMIT 4";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    //show data
    public function show(){
        $query = "SELECT * FROM cauhoi WHERE id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->title = $row['title'];
        $this->a = $row['a'];
        $this->b = $row['b'];
        $this->c = $row['c'];
        $this->d = $row['d'];
        $this->result = $row['result'];
    }

    //create data
    public function create(){

        $query = "INSERT INTO cauhoi SET title=:title, a=:a, b=:b, c=:c, d=:d, result=:result ";

        $stmt = $this->conn->prepare($query);
        //clean data(bo ki tu dac. biet., ko mong muon)

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->a = htmlspecialchars(strip_tags($this->a));
        $this->b = htmlspecialchars(strip_tags($this->b));
        $this->c = htmlspecialchars(strip_tags($this->c));
        $this->d = htmlspecialchars(strip_tags($this->d));
        $this->result = htmlspecialchars(strip_tags($this->result));
        //bind data
        $stmt->bindParam(':title',$this->title);
        $stmt->bindParam(':a',$this->a);
        $stmt->bindParam(':b',$this->b);
        $stmt->bindParam(':c',$this->c);
        $stmt->bindParam(':d',$this->d);
        $stmt->bindParam(':result',$this->result);

        if($stmt->execute()){
            return true;
        }
        printf("Error %s.\n" ,$stmt->error);
        return false;
    }

    //update
    public function update(){

        $query = "UPDATE cauhoi SET title=:title, a=:a, b=:b, c=:c, d=:d, result=:result WHERE id =:id";

        $stmt = $this->conn->prepare($query);
        //clean data(bo ki tu dac. biet., ko mong muon)
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->title = htmlspecialchars(strip_tags($this->title));  
        $this->a = htmlspecialchars(strip_tags($this->a));
        $this->b = htmlspecialchars(strip_tags($this->b));
        $this->c = htmlspecialchars(strip_tags($this->c));
        $this->d = htmlspecialchars(strip_tags($this->d));
        $this->result = htmlspecialchars(strip_tags($this->result));
        //bind data
        $stmt->bindParam(':title',$this->title);
        $stmt->bindParam(':a',$this->a);
        $stmt->bindParam(':b',$this->b);
        $stmt->bindParam(':c',$this->c);
        $stmt->bindParam(':d',$this->d);
        $stmt->bindParam(':result',$this->result);
        $stmt->bindParam(':id',$this->id);

        if($stmt->execute()){
            return true;
        }
        printf("Error %s.\n" ,$stmt->error);
        return false;
    }

    //delete
    public function delete(){

        $query = "DELETE FROM cauhoi WHERE id =:id";

        $stmt = $this->conn->prepare($query);
        //clean data(bo ki tu dac. biet., ko mong muon)
        $this->id = htmlspecialchars(strip_tags($this->id));
    
        //bind data
        $stmt->bindParam(':id',$this->id);

        if($stmt->execute()){
            return true;
        }
        printf("Error %s.\n" ,$stmt->error);
        return false;
    }
}
?>