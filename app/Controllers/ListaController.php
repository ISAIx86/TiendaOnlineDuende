<?php

namespace App\Controllers;

use App\Repositories\ListaDAO;

class ListaController extends ListaDAO {

    // Métodos débiles
    private function hasEmptyInput(Lista $lst) {
        if(
            empty($lst->getCreador()) |
            empty($lst->getNombre()) |
            empty($lst->getDescripcion())
        ) {
            return true;
        } else return false;
    }

    private function checkImageAndSet(Lista &$lst) {
        $img_info = $lst->getImagenInfo();
        $img_ex = strtolower(pathinfo($img_info["name"], PATHINFO_EXTENSION));
        $allowed_exs = array("jpg", "jpeg", "png");
        if ($img_info["name"] == "") {
            $lst->setImagenDir(null)
                ->setImagen(null);
            return "img_ok";
        }
        if ($img_info["error"] != 0) {
            return "img_error";
        } else if ($img_info["size"] > 8388608) {
            return "img_oversize";
        }
        else if (!in_array($img_ex, $allowed_exs)) {
            return "img_wrongext";
        }
        $new_img_name = uniqid("IMG-", true).'.'.$img_ex;
        $img_upload_path = "resources/lists/$new_img_name";
        $lst->setImagenDir($img_upload_path)
            ->setImagen(file_get_contents($img_info["tmp_name"]));
        $result = move_uploaded_file($img_info["tmp_name"], __ROOT.$img_upload_path);
        return "img_ok";
    }

    // Métodos fuertes
    public function crearLista(Lista $lst) {
        if ($this->hasEmptyInput($lst)) {
            return "empty_inputs";
        }
        $img_result = $this->checkImageAndSet($lst);
        if ($img_result != "img_ok") {
            return $img_result;
        }
        return $this->lst_crear($lst);
    }

    public function modificarLista(Lista $lst) {
        if (empty($lst->getID())) {
            return "uncaptured_id";
        }
        if ($this->hasEmptyInput($lst)) {
            return "empty_inputs";
        }
        $img_result = $this->checkImageAndSet($lst);
        if ($img_result != "img_ok") {
            return $img_result;
        }
        return $this->lst_modificar($lst);
    }
    
    public function borrarCategoria($id_list, $id_user) {
        if (empty($id_list)) {
            return "uncaptured_id";
        }
        if (empty($id_user)) {
            return "uncaptured_user";
        }
        return $this->lst_baja($id_list, $id_user);
    }

    public function obtenerListas($id_user) {
        if (empty($id_user)) {
            return "uncaptured_id";
        }
        return $this->lst_getcards($id_user);
    }

    public function obtenerListasUsuario($id_user) {
        if (empty($id_user)) {
            return "uncaptured_id";
        }
        return $this->lst_getcardsuser($id_user);
    }

    public function obtenerInfoLista($id_list, $id_user) {
        if (empty($id_list)) {
            return "uncaptured_id";
        }
        if (empty($id_user)) {
            return "uncaptured_user";
        }
        return $this->lst_get($id_list, $id_user);
    }

    public function obtenerProductos($id_list) {
        if (empty($id_list)) {
            return "uncaptured_id";
        }
        return $this->lst_getitems($id_list);
    }
    
}

?>