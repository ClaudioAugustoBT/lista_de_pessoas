<?php

//============================================================+
//API cadastro de pessoas
//============================================================+

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once(dirname(__FILE__) . '/config.php');
require_once(dirname(__FILE__) . '/Database.php');
require_once(dirname(__FILE__) . '/Pessoa.php');

$database = new Database;
$db = $database->connect();

$pessoa = new Pessoa($db);

/*
** Consultar Pessoas
** ============================================================+
** Method:GET 
** Sem parametros -> -> retorna json com todas pessoas cadastras
** $_GET['id'] = 'id' -> retorna pessoa por 
** $_GET['reset'] = 1 -> Reset da base de dados
** ============================================================+
*/

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['reset'])) {
        echo $pessoa->resetDB();
    } else {
        try {
            $id = isset($_GET['id']) ? $_GET['id'] : null;
            $pessoas = $pessoa->getPessoa($id);
            $p_arr["pessoas"] = array();

            foreach ($pessoas as $pessoa) {
                $obj["nome"] = $pessoa["nm_pessoa"];
                $obj_filhos = array();
                if (count($pessoa["filhos"]) > 0) {
                    foreach ($pessoa["filhos"] as $filho) {
                        array_push($obj_filhos, $filho["nm_filho"]);
                    }
                }
                $obj["filhos"] = $obj_filhos;
                array_push($p_arr["pessoas"], $obj);
            }

            echo json_encode($p_arr);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
} else {
    die("Metodo de requisição inválido!");
}
