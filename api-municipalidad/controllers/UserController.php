<?php
// app/controllers/UserController.php

include_once '../models/User.php';
include_once '../core/Database.php';

class UserController {
    private $db;
    private $usuario;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->usuario = new User($this->db);
    }

    // Obtener todos los usuarios
    public function getAll() {
        header('Content-Type: application/json'); 
        try {
            $stmt = $this->usuario->getAll();
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($usuarios);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["message" => "Error al recuperar usuarios", "error" => $e->getMessage()]);
        }
    }

    // Obtener un Usuario por ID
    public function getById($id) {
        header('Content-Type: application/json'); 
        try {
            $usuario = $this->usuario->getById($id);
            echo json_encode($usuario);
        } catch (Exception $e) {
            http_response_code(404);
            echo json_encode(["message" => "Usuario no encontrado", "error" => $e->getMessage()]);
        }
    }

    // Crear un nuevo Usuario
    public function create($data) {
        header('Content-Type: application/json'); 
        $this->usuario->nombre = $data->nombre;
        $this->usuario->email = $data->email;
        $this->usuario->pass = $data->pass;
        
        if ($this->usuario->create()) {
            http_response_code(201);
            echo json_encode(["message" => "Usuario creado con éxito"]);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Error al crear el Usuario"]);
        }
    }

    // Actualizar un Usuario
    public function update($id, $data) {
        header('Content-Type: application/json'); 
        $this->usuario->nombre = $data->nombre;
        $this->usuario->email = $data->email;
        $this->usuario->pass = $data->pass;
        
        if ($this->usuario->update($id)) {
            echo json_encode(["message" => "Usuario actualizado con éxito"]);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Error al actualizar el Usuario"]);
        }
    }

    // Eliminar un Usuario
    public function delete($id) {
        header('Content-Type: application/json'); 
        if ($this->usuario->delete($id)) {
            echo json_encode(["message" => "Usuario eliminado con éxito"]);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Error al eliminar el Usuario"]);
        }
    }
}
?>
