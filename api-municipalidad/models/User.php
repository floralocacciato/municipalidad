<?php
// app/models/.php

class User {
    private $conn;
    private $table = "usuarios";

    public $id;
    public $nombre;
    public $email;
    public $pass;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todos los productos
    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Obtener un solo producto por ID
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear un producto nuevo
    public function create() {
        $query = "INSERT INTO " . $this->table . " (nombre, email, pass) VALUES (:nombre, :email, :pass)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':pass', $this->pass);
        return $stmt->execute();
    }

    // Actualizar un producto
    public function update($id) {
        $query = "UPDATE " . $this->table . " SET nombre = :nombre, email = :email, pass = :pass WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':pass', $this->pass);
        return $stmt->execute();
    }

    // Eliminar un producto
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>