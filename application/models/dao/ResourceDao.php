<?php

namespace Model\Dao;

class ResourceDao extends \Core\Dao
{

    public function __construct()
    {
        parent::__construct();
    }

    public function lista()
    {
        $roles = null;
        
        try {
            $sql = "SELECT * FROM auth_resource";
            $stmt = $this->conexao->query($sql);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, '\\Model\\Resource');

            if ($stmt->rowCount() > 0) {
                $roles = array();
                while ($resource = $stmt->fetch()) {
                    array_push($resources, $resource);
                }

                return $resources;
            }
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

    public function busca($id)
    {
        try {
            $sql = "SELECT * FROM auth_resource WHERE id = ?";
            $stmt = $this->conexao->prepare($sql);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, '\\Model\\Resource');
            $stmt->bindParam(1, $id, \PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $resource = $stmt->fetch();
            }

            return $resource;
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

    public function exclui($resource)
    {
        $id = $resource->getId();

        try {
            $sql = "DELETE FROM auth_resource WHERE id = ?";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $id, \PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

    public function atualiza($resource)
    {
        try {
            $sql = "UPDATE auth_resource SET controller = ?, method = ?";

            $id = $resource->getId();
            $controller = $resource->getController();
            $method = $resource->getMethod();

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $controller, \PDO::PARAM_STR);
            $stmt->bindParam(2, $method, \PDO::PARAM_STR);
            $stmt->bindParam(3, $id, \PDO::PARAM_INT);

            return $stmt->execute();
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

    public function insere($resource)
    {
        try {
            $sql = " INSERT INTO auth_resource(controller, method) VALUES (?, ?)";

            $controller = $resource->getController();
            $method = $resource->getMethod();

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $controller, \PDO::PARAM_STR);
            $stmt->bindParam(2, $method, \PDO::PARAM_STR);

            return $stmt->execute();
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

}
