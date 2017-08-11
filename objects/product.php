<?php

/**
 * Created by PhpStorm.
 * User: SAJID
 * Date: 5/19/2017
 * Time: 10:26 PM
 */
class Product {

  public $id;
  public $name;
  public $descripton;
  public $price;
  public $categoryId;
  public $timestamp;

  private $conn;
  private $table_name = 'products';

  public function __construct($db) {
    $this->conn = $db;
  }

  function create() {

    $sql = "INSERT INTO " . $this->table_name . " SET name=:name, description=:description, category_id=:category, price=:price, created=:created";
    $stmt = $this->conn->prepare($sql);

    //posted values
    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->descripton = htmlspecialchars(strip_tags($this->descripton));
    $this->price = htmlspecialchars(strip_tags($this->price));
    $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

    $this->timestamp = date('Y-m-d H:i:s');

    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':description', $this->descripton);
    $stmt->bindParam(':category', $this->categoryId);
    $stmt->bindParam(':price', $this->price);
    $stmt->bindParam(':created', $this->timestamp);

    if ($stmt->execute()) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }

  function readAll($from_record_num, $records_per_page) {
    $sql = "SELECT id,name,description,price,category_id FROM " . $this->table_name . " ORDER BY name ASC LIMIT {$from_record_num},{$records_per_page}";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  function countAll() {
    $sql = "SELECT id FROM " . $this->table_name;
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();

    $res = $stmt->rowCount();

    return $res;
  }

  function read_one() {
    $sql = "SELECT id,name,description,price,category_id FROM " . $this->table_name . " WHERE id=?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
    return $stmt;
  }

  function update() {
    $sql = "UPDATE " . $this->table_name . " SET name=:name,description=:descrip,price=:price,category_id=:category WHERE id=:id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':descrip', $this->descripton);
    $stmt->bindParam(':price', $this->price);
    $stmt->bindParam(':category', $this->categoryId);
    $stmt->bindParam(':id', $this->id);
    $stmt->execute();
    return $stmt;
  }

  function delete() {
    $sql = "DELETE FROM " . $this->table_name . " WHERE id=?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(1, $this->id);
    return $stmt;
  }

}