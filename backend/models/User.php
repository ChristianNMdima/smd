<?php 
  class User {

    private $conn;
    private $table = 'user';

    public $user_id;
    public $name;
    public $email;
    public $phone_number;
    public $dob; // Date of birth
    public $age;
    public $gender;
    public $car_make;
    public $car_colour;
    public $created;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get requests
    public function read() {
      $query = 'SELECT *  FROM ' . $this->table;
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      return $stmt;
    }


    public function read_single() {
        
          // Create query
          $query = 'SELECT * FROM ' . $this->table . ' WHERE email = :email';
  
          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(':email', $this->mobile);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->user_id = $row['user_id'];
          $this->name = $row['name'];
          $this->email = $row['email'];
          $this->phone_number = $row['phone_number'];
          $this->dob = $row['dob'];
          $this->gender = $row['gender'];
          $this->car_make = $row['car_make'];
          $this->car_colour = $row['car_colour'];
          $this->created = $row['created'];
 
    }

    // Create User
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET name = :name, email = :email, phone_number = :phone_number, dob = :dob, age = :age, gender = :gender, car_make = :car_make, car_colour = :car_colour, created = :created
          ON DUPLICATE KEY UPDATE name = :name, email = :email, phone_number = :phone_number, dob = :dob, age = :age, gender = :gender, car_make = :car_make, car_colour = :car_colour';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->email = htmlspecialchars(strip_tags($this->email));
          $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
          $this->dob = $this->dob;
          $this->age = $this->age;
          $this->gender = $this->gender;
          $this->car_make = htmlspecialchars(strip_tags($this->car_make));
          $this->car_colour = htmlspecialchars(strip_tags($this->car_colour));
          $this->created = $this->created;

          // Bind data
          $stmt->bindParam(':name', $this->name);
          $stmt->bindParam(':email', $this->email);
          $stmt->bindParam(':phone_number', $this->phone_number);
          $stmt->bindParam(':dob', $this->dob);
          $stmt->bindParam(':age', $this->age);
          $stmt->bindParam(':gender', $this->gender);
          $stmt->bindParam(':car_make', $this->car_make);
          $stmt->bindParam(':car_colour', $this->car_colour);
          $stmt->bindParam(':created', $this->created);

          
           try {

             $stmt->execute();
             return true;
             
           } catch(PDOException $e) {

             //echo $e->getMessage();
             return false;
          }
          
      
    }

    // Update User
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . '
                                SET name = :name, phone_number = :phone_number, dob = :dob, age = :age, gender = :gender, car_make = :car_make, car_colour = :car_colour
                                WHERE email = :email';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->email = htmlspecialchars(strip_tags($this->email));
          $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
          $this->dob = $this->dob;
          $this->age = $this->age;
          $this->gender = $this->gender;
          $this->car_make = htmlspecialchars(strip_tags($this->car_make));
          $this->car_colour = htmlspecialchars(strip_tags($this->car_colour));

          // Bind data
          $stmt->bindParam(':name', $this->name);
          $stmt->bindParam(':email', $this->email);
          $stmt->bindParam(':phone_number', $this->phone_number);
          $stmt->bindParam(':dob', $this->dob);
          $stmt->bindParam(':age', $this->age);
          $stmt->bindParam(':gender', $this->gender);
          $stmt->bindParam(':car_make', $this->car_make);
          $stmt->bindParam(':car_colour', $this->car_colour);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    // Delete User
    public function delete() {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE user_id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->user_id));

          // Bind data
          $stmt->bindParam(':user_id', $this->user_id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }