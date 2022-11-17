<?php

require_once "categoria_dao.classes.php";

class CategoriaController extends CategoriaDAO {

    // Métodos débiles
    private function hasEmptyInput(Categoria $cat) {
        if(
            empty($cat->getNombre()) |
            empty($cat->getDescripcion()) 
        ) {
            return true;
        } else return false;
    }

    private function categoCheck($name) {
        return $this->cat_checar_nombre($name);
    }

    // Métodos fuertes
    public function crearCategoria(Categoria $cat) {
        if ($this->hasEmptyInput($cat)) {
            return "empty_inputs";
        }
        if ($this->categoCheck($cat->getNombre())) {
            return "already_exists";
        }
        return $this->cat_crear($cat);
    }

    public function modificarCategoria(Categoria &$cat) {
        if (empty($cat->getID())) {
            return "uncaptured_id";
        }
        if ($this->hasEmptyInput($cat)) {
            return "empty_inputs";
        }
        return $this->cat_modificar($cat);
    }
    
    public function borrarCategoria($id) {
        if (empty($id)) {
            return "uncaptured_id";
        }
        return $this->cat_baja($id);
    }

    public function autorizarCategoria($id, $auto) {
        if (empty($id)) {
            return "uncaptured_id";
        }
        if (empty($auto)) {
            return "empty_inputs";
        }
        return $this->cat_authorize($id, $auto);
    }

    public function buscarPorNombre($texto) {
        if (empty($texto)) {
            return "empty";
        }
        return $this->cat_busqueda($texto);
    }
    
}

?>