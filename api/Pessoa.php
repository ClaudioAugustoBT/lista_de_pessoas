<?php

class Pessoa
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getPessoa($id = null)
    {
        if (!$id) {
            $query =  "SELECT * FROM tb_pessoa";
        } else {
            $query = "SELECT * FROM tb_pessoa WHERE id_pessoa=" . $id;
        }

        $pessoas = $this->conn->query($query)->fetch_all(MYSQLI_ASSOC);

        for ($i = 0; $i < count($pessoas); $i++) {
            $filhos = $this->getFilho($pessoas[$i]["id_pessoa"]);
            $pessoas[$i]["filhos"] = $filhos;
        }

        return $pessoas;
    }

    public function getFilho($id)
    {
        $query =  "SELECT * FROM tb_filho where id_pessoa=" . $id;
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function gravarPessoas($pessoas)
    {
        $this->resetDB();
        foreach ($pessoas as $pessoa) {
            $query = 'INSERT INTO tb_pessoa (id_pessoa,nm_pessoa) VALUES (null,"' . $pessoa->nome . '")';
            $this->conn->query($query);
            $id_pessoa = mysqli_insert_id($this->conn);
            if (count($pessoa->filhos) > 0) {
                foreach ($pessoa->filhos as $filho) {
                    $query_filho = 'INSERT INTO tb_filho (id_filho, id_pessoa,nm_filho) VALUES (null,' . $id_pessoa . ',"' . $filho . '")';
                    $this->conn->query($query_filho);
                }
            }
        }

        return true;
    }

    public function resetDB()
    {
        $status = 0;
        mysqli_query($this->conn, 'TRUNCATE TABLE tb_filho') ? $status = 1 : $status = mysqli_error($this->conn);
        mysqli_query($this->conn, 'TRUNCATE TABLE tb_pessoa') ? $status = 1 : $status = mysqli_error($this->conn);

        return $status;
    }
}
