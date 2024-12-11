<?php
require_once './config.php';

class Product
{
    public $db;
    private $id;
    private $name;
    private $price;

    public function __construct()
    {
        // Initialize database connection
        $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    
    public static function getAll()
    {
        $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $db->query('SELECT * FROM products');
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id)
    {
        $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $db->prepare(query: 'SELECT * FROM products WHERE id = :id');
        $query->bindParam(':id',$id, PDO::PARAM_INT);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function save()
    {
        $query = $this->db->prepare('INSERT INTO products (name, price) VALUES (:name, :price)');
        $query->bindParam(':name', $this->name, PDO::PARAM_STR);
        $query->bindParam(':price', $this->price, PDO::PARAM_STR);
        $query->execute();
    }

    public function update(): bool
    {
        try {
            $stmt = $this->db->prepare("UPDATE products SET name = :name, price = :price WHERE id = :id");
            $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
            $stmt->bindParam(':price', $this->price, PDO::PARAM_STR);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->execute();
        
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
        $stmt->execute(['id' => $id]);
    
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    


    public function getName() {
      return $this->name;
    }
    public function setName($value) {
      $this->name = $value;
    }

    public function getPrice() {
      return $this->price;
    }
    public function setPrice($value) {
      $this->price = $value;
    }

    public function getId() {
      return $this->id;
    }
    public function setId($value) {
      $this->id = $value;
    }
}
?>
