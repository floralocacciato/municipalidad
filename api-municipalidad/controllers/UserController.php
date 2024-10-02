<?php
// app/controllers/ProductController.php

include_once '../models/User.php';
include_once '../core/Database.php';

class ProductController {
    private $db;
    private $usuario;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->usuario = new Usuario($this->db);
    }

   

    // Obtener todos los usuarios
    public function getAll() {
        header('Content-Type: application/json'); 
        $this->setJsonHeader();  // Establecer la cabecera antes de enviar la respuesta
        $stmt = $this->usuario->getAll();
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($usuarios);  // Cambiar return por echo para enviar la respuesta
    }

    // Obtener un Usuario por ID
    public function getById($id) {
        header('Content-Type: application/json'); 
        $this->setJsonHeader();
        $usuario = $this->usuario->getById($id);
        echo json_encode($usuario);
    }

    // Crear un nuevo Usuario
    public function create($data) {
        header('Content-Type: application/json'); 
        $this->setJsonHeader();
        $this->usuario->nombre = $data->nombre;
        $this->usuario->email = $data->email;
        $this->usuario->pass = $data->pass;
        if ($this->usuario->create()) {
            echo json_encode(["message" => "Usuario creado con éxito"]);
        } else {
            echo json_encode(["message" => "Error al crear el Usuario"]);
        }
    }

    // Actualizar un Usuario
    public function update($id, $data) {
        header('Content-Type: application/json'); 
        $this->setJsonHeader();
        $this->usuario->nombre = $data->nombre;
        $this->usuario->email = $data->email;
        $this->usuario->pass = $data->pass;
        if ($this->usuario->update($id)) {
            echo json_encode(["message" => "Usuario actualizado con éxito"]);
        } else {
            echo json_encode(["message" => "Error al actualizar el Usuario"]);
        }
    }

    // Eliminar un Usuario
    public function delete($id) {
        header('Content-Type: application/json'); 
        $this->setJsonHeader();
        if ($this->usuario->delete($id)) {
            echo json_encode(["message" => "Usuario eliminado con éxito"]);
        } else {
            echo json_encode(["message" => "Error al eliminar el Usuario"]);
        }
    }
}
?>