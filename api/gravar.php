<?php

//============================================================+
//API cadastro de pessoas
//============================================================+

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once(dirname(__FILE__) . '/config.php');
require_once(dirname(__FILE__) . '/Database.php');
require_once(dirname(__FILE__) . '/Pessoa.php');

$database = new Database;
$db = $database->connect();

$pessoa = new Pessoa($db);

/*
** GRAVAR Pessoas
** ============================================================+
** Method:POST 
** $_POST['json_pessoas']
** ============================================================+
*/

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['json_pessoas'])) {
        try {
            $post_pessoas = json_decode($_POST["json_pessoas"]);

            $result = $pessoa->gravarPessoas($post_pessoas->pessoas);

            echo $result;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        die("Faltam parametros!");
    }
} else {
    die("Metodo de requisição inválido!sdas");
}
