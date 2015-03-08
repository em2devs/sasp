<?php

namespace Model\Dao;

class RoleDao extends \Core\Dao
{

    public function __construct()
    {
        parent::__construct();
    }

    public function lista()
    {
        $roles = null;
        
        try {
            $sql = "SELECT * FROM auth_role";
            $stmt = $this->conexao->query($sql);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, '\\Model\\Role');

            if ($stmt->rowCount() > 0) {
                $roles = array();
                while ($role = $stmt->fetch()) {
                    array_push($roles, $role);
                }

                return $roles;
            }
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

    public function busca($id)
    {
        try {
            $sql = "SELECT * FROM auth_role WHERE id = ?";
            $stmt = $this->conexao->prepare($sql);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, '\\Model\\Role');
            $stmt->bindParam(1, $id, \PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $role = $stmt->fetch();
            }

            return $role;
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

    public function exclui($role)
    {
        $id = $role->getId();

        try {
            $sql = "DELETE FROM auth_role WHERE id = ?";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $id, \PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

    public function atualiza($role)
    {
        try {
            $sql = "UPDATE auth_role SET nome = ?, descricao = ?";

            $id = $role->getId();
            $nome = $role->getNome();
            $descricao = $role->getDescricao();

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $nome, \PDO::PARAM_STR);
            $stmt->bindParam(2, $descricao, \PDO::PARAM_STR);
            $stmt->bindParam(3, $id, \PDO::PARAM_INT);

            return $stmt->execute();
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

    public function insere($role)
    {
        try {
            $sql = " INSERT INTO auth_role(nome, descricao) VALUES (?, ?)";

            $nome = $role->getNome();
            $descricao = $role->getDescricao();

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $nome, \PDO::PARAM_STR);
            $stmt->bindParam(2, $descricao, \PDO::PARAM_STR);

            return $stmt->execute();
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

}
