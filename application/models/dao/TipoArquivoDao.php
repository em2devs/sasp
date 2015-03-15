<?php

namespace Model\Dao;

class TipoArquivoDao extends \Core\Dao
{

    public function __construct()
    {
        parent::__construct();
    }

    public function lista()
    {
        $tiposArquivo = null;
        $sql = "SELECT * FROM tipo_arquivo";
        $stmt = $this->conexao->query($sql);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, '\\Model\\TipoArquivo');

        if ($stmt->rowCount() > 0) {
            $tiposArquivo = array();
            while ($tipoArquivo = $stmt->fetch()) {
                array_push($tiposArquivo, $tipoArquivo);
            }
            return $tiposArquivo;
        }
    }

    public function busca($id)
    {
        try {
            $sql = "SELECT * FROM tipo_arquivo WHERE id = ?";
            $stmt = $this->conexao->prepare($sql);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, '\\Model\\TipoArquivo');
            $stmt->bindParam(1, $id, \PDO::PARAM_INT);
            $stmt->execute();

            $tipoArquivo = new \Model\TipoArquivo();

            if ($stmt->rowCount() > 0) {
                $tipoArquivo = $stmt->fetch();
            }
            return $tipoArquivo;
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

    public function buscaPorNome($nome)
    {
        $nome = str_replace('-', ' ', $nome);
        $tiposArquivo = null;
        
        try {
            $sql = "SELECT * FROM tipo_arquivo WHERE nome LIKE ?";
            $stmt = $this->conexao->prepare($sql);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, '\\Model\\TipoArquivo');
            $stmt->bindValue(1, "%$nome%", \PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $tiposArquivo = array();

                while ($tipoArquivo = $stmt->fetch()) {
                    array_push($tiposArquivo, $tipoArquivo);
                }

                return $tiposArquivo;
            }
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

    public function insere($tipoArquivo)
    {
        try {
            $sql = "INSERT INTO tipo_arquivo (nome) VALUES (?)";
            $nome = $tipoArquivo->getNome();

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $nome, \PDO::PARAM_STR);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, '\\Model\\TipoArquivo');
            return $stmt->execute();
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }
    
    public function exclui($tipoArquivo)
    {
        $id = $tipoArquivo->getId();

        try {
            $sql = "DELETE FROM tipo_arquivo WHERE id = ?";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $id, \PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

}
