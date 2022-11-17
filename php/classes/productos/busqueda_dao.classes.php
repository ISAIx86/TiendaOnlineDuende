<?php 

require_once __ROOT."/php/classes/dbo.classes.php";

class BusquedaProdDAO extends DBH {

    // Statement
    protected function prepareStatement($proc) {
        $this->setPrepareStatement("call sp_BusquedaProd('".$proc."', ?, ?, ?, ?, ?);");
    }

    private function executeCall($data) {
        return $this->executeQuery(array(
            $data['in_titulo'],
            $data['in_orden'],
            $data['in_categorias'],
            $data['in_page'],
            $data['in_size']
        ));
    }

    // Consultas
    protected function get_vendidos() {

        $this->prepareStatement('get_vendidos');

        $data = array(
            'in_titulo'=>null,
            'in_orden'=>null,
            'in_categorias'=>null,
            'in_page'=>null,
            'in_size'=>null
        );

        if (!$this->executeCall($data)) {
            return "query_error";
        }

        $rt_data = $this->fetchData();
        $result = array();

        foreach ($rt_data as &$row) {
            array_push($result, array(
                "rs_id"=>$row['out_id'],
                "rs_titulo"=>$row['out_titulo'],
                "rs_descripcion"=>$row['out_descripcion'],
                "rs_precio"=>$row['out_precio']
            ));
        }
        return $result;

    }

    protected function get_vistos() {

        $this->prepareStatement('get_vistos');

        $data = array(
            'in_titulo'=>null,
            'in_orden'=>null,
            'in_categorias'=>null,
            'in_page'=>null,
            'in_size'=>null
        );

        if (!$this->executeCall($data)) {
            return "query_error";
        }

        $rt_data = $this->fetchData();
        $result = array();

        foreach ($rt_data as &$row) {
            array_push($result, array(
                "rs_id"=>$row['out_id'],
                "rs_titulo"=>$row['out_titulo'],
                "rs_descripcion"=>$row['out_descripcion'],
                "rs_precio"=>$row['out_precio']
            ));
        }
        return $result;

    }

    protected function get_recomend() {

        $this->prepareStatement('get_recomend');

        $data = array(
            'in_titulo'=>null,
            'in_orden'=>null,
            'in_categorias'=>null,
            'in_page'=>null,
            'in_size'=>null
        );

        if (!$this->executeCall($prod)) {
            return "query_error";
        }

        $rt_data = $this->fetchData();
        $result = array();

        foreach ($rt_data as &$row) {
            array_push($result, array(
                "rs_id"=>$row['out_id'],
                "rs_titulo"=>$row['out_titulo'],
                "rs_descripcion"=>$row['out_descripcion'],
                "rs_precio"=>$row['out_precio']
            ));
        }
        return $result;

    }

    protected function adv_search($titulo, $order, $catego, $page, $size) {

        $this->prepareStatement('adv_search');

        $data = array(
            'in_titulo'=>$titulo,
            'in_orden'=>$order,
            'in_categorias'=>null,
            'in_page'=>$page,
            'in_size'=>$size
        );

        if (!$this->executeCall($data)) {
            return "query_error";
        }

        $result = $this->fetchData();

        return $result;

    }

}

?>