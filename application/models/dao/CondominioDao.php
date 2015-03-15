<?php

namespace Model\Dao;

class CondominioDao extends \Core\Dao
{

    public function __construct()
    {
        parent::__construct();
    }

    public function lista()
    {
        $condominios = null;
        
        try {
            $sql = "SELECT * FROM condominio";
            $stmt = $this->conexao->query($sql);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, '\\Model\\Condominio');

            if ($stmt->rowCount() > 0) {
                $condominios = array();

                while ($condominio = $stmt->fetch()) {
                    array_push($condominios, $condominio);
                }

                return $condominios;
            }
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

    //retorna uma lista de condominios pelo nome, usando like
    public function buscaPorNome($nome)
    {
        $condominios = null;
        
        try {

            $sql = "SELECT * FROM condominio WHERE nome like '%{$nome}%' ";
            $stmt = $this->conexao->query($sql);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, '\\Model\\Condominio');

            if ($stmt->rowCount() > 0) {
                $condominios = array();

                while ($condominio = $stmt->fetch()) {
                    array_push($condominios, $condominio);
                }

                return $condominios;
            }
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

    //Retorna um objeto do tipo Condominio baseado no ID
    public function busca($id)
    {
        try {
            $sql = "SELECT * FROM condominio WHERE id = ?";
            $stmt = $this->conexao->prepare($sql);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, '\\Model\\Condominio');
            $stmt->bindParam(1, $id, \PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $condominio = $stmt->fetch();
            }

            return $condominio;
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

    public function atualiza($condominio)
    {
        try {
            $sql = "UPDATE condominio SET nome = ?, cep = ? , endereco_tipo = ?, endereco_nome = ?, ";
            $sql = $sql . "endereco_numero = ?, qtd_aptos = ?, qtd_blocos = ? WHERE id = ? ";

            $nome = $condominio->getNome();
            $cep = $condominio->getCep();
            $enderecoTipo = $condominio->getEnderecoTipo();
            $enderecoNome = $condominio->getEnderecoNome();
            $enderecoNumero = $condominio->getEnderecoNumero();
            $quantidadeAptos = $condominio->getQuantidadeAptos();
            $quantidadeBlocos = $condominio->getQuantidadeBlocos();
            $id = $condominio->getId();

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $nome, \PDO::PARAM_STR);
            $stmt->bindParam(2, $cep, \PDO::PARAM_INT);
            $stmt->bindParam(3, $enderecoTipo, \PDO::PARAM_STR);
            $stmt->bindParam(4, $enderecoNome, \PDO::PARAM_STR);
            $stmt->bindParam(5, $enderecoNumero, \PDO::PARAM_INT);
            $stmt->bindParam(6, $quantidadeAptos, \PDO::PARAM_INT);
            $stmt->bindParam(7, $quantidadeBlocos, \PDO::PARAM_INT);
            $stmt->bindParam(8, $id, \PDO::PARAM_INT);

            return $stmt->execute();
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

    public function insere($condominio)
    {
        try {
            $sql = "INSERT INTO condominio(nome, cep, endereco_tipo, endereco_nome , endereco_numero ";
            $sql = $sql . ", qtd_aptos , qtd_blocos , dt_hr_cadastro) VALUES ";
            $sql = $sql . "(?, ?, ?, ?, ?, ?, ?, now())";

            $nome = $condominio->getNome();
            $cep = $condominio->getCep();
            $enderecoTipo = $condominio->getEnderecoTipo();
            $enderecoNome = $condominio->getEnderecoNome();
            $enderecoNumero = $condominio->getEnderecoNumero();
            $quantidadeAptos = $condominio->getQuantidadeAptos();
            $quantidadeBlocos = $condominio->getQuantidadeBlocos();


            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $nome, \PDO::PARAM_STR);
            $stmt->bindParam(2, $cep, \PDO::PARAM_INT);
            $stmt->bindParam(3, $enderecoTipo, \PDO::PARAM_STR);
            $stmt->bindParam(4, $enderecoNome, \PDO::PARAM_STR);
            $stmt->bindParam(5, $enderecoNumero, \PDO::PARAM_INT);
            $stmt->bindParam(6, $quantidadeAptos, \PDO::PARAM_INT);
            $stmt->bindParam(7, $quantidadeBlocos, \PDO::PARAM_INT);

            return $stmt->execute();
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

    public function exclui(\Model\Condominio $condominio)
    {
        $id = $condominio->getId();

        try {
            $sql = "SELECT * FROM usuario WHERE id_condominio = ?";
            $stmt = $this->conexao->prepare($sql);
            $stmt->setFetchMode(\PDO::FETCH_NUM);
            $stmt->bindParam(1, $id, \PDO::PARAM_INT);
            $stmt->execute();
            
            if ($stmt->rowCount() === 0) {
                $sql = "DELETE FROM condominio WHERE id = ?";
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindParam(1, $id, \PDO::PARAM_INT);
                
                return $stmt->execute();
            } else {
                return false;
            }
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

}
