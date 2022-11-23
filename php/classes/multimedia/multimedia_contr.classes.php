<?php

require_once "multimedia_dao.classes.php";

class MultimediaController extends MultimediaDAO {

    // Métodos débiles
    private function hasEmptyInput(Producto $prod) {
        if (
            empty($prod->getTitulo()) |
            empty($prod->getDescripcion()) |
            empty($prod->getDisponibilidad()) |
            $prod->getCotizacion() != null |
            empty($prod->getPrecio())
        ) {
            return true;
        } else return false;
    }

    private function checkFileAndSet(Multimedia &$mult) {
        $file_info = $mult->getMultiInfo();
        $file_ex = strtolower(pathinfo($file_info["name"], PATHINFO_EXTENSION));
        $allowed_exs = array("jpg", "jpeg", "png", "gif", "mp4");
        $img_exs = array("jpg", "jpeg", "png", "gif");
        $vid_exs = array("mp4");
        if ($file_info["name"] == "") {
            return "file_empty";
        }
        if ($file_info["error"] != 0) {
            return "file_error";
        } else if ($file_info["size"] > 37748736) {
            return "file_oversize";
        }
        else if (!in_array($file_ex, $allowed_exs)) {
            return "file_wrongext";
        }
        $file_upload_path = "";
        if (in_array($file_ex, $img_exs)) {
            $new_file_name = uniqid("img-", true).'.'.$file_ex;
            $file_upload_path = "/resources/productos/img/$new_file_name";
            $mult->setContenidoDir($file_upload_path)
                 ->setContenido(file_get_contents($file_info["tmp_name"]))
                 ->setTipo('i');
        } else if (in_array($file_ex, $vid_exs)) {
            $new_file_name = uniqid("vid-", true).'.'.$file_ex;
            $file_upload_path = "/resources/productos/vid/$new_file_name";
            $mult->setContenidoDir($file_upload_path)
                 ->setContenido(null)
                 ->setTipo('v');
        }
        move_uploaded_file($file_info["tmp_name"], __ROOT.$file_upload_path);
        return "file_ok";
    }

    // Métodos fuertes
    public function insertarMultimedia($id_prod, $mult_array) {
        if (empty($id_prod)) {
            return "uncaptured_id";
        }
        if (count($mult_array) == 0) {
            return "empty_files";
        }
        foreach ($mult_array as &$mult) {
            $new_mult = Multimedia::create()
                ->setProductoID($id_prod)
                ->setMultiInfo($mult);
            $file_result = $this->checkFileAndSet($new_mult);
            if ($file_result != "file_ok") {
                continue;
            }
            $this->mult_create($new_mult);
        }
        return true;
    }

    public function obtenerImagen($id_prod) {
        if (empty($id_prod)) {
            return "uncaptured_id";
        }
        return $this->mult_getimg($id_prod);
    }

    public function obtenerArchivos($id_prod) {
        if (empty($id_prod)) {
            return "uncaptured_id";
        }
        return $this->mult_getfiles($id_prod);
    }

}

?>