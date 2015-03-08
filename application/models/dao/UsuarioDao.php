<?php

namespace Model\Dao;

class UsuarioDao extends \Core\Dao
{

    public function __construct()
    {
        parent::__construct();
    }

    public function buscaLogin($login, $senha)
    {
        try {

            $sql = "SELECT * FROM usuario WHERE login = ?";
            $stmt = $this->conexao->prepare($sql);
            // atribui os valores às propriedades e cria uma instância do objeto
            $stmt->setFetchMode(\PDO::FETCH_CLASS, '\\Model\\Usuario');
            // cria uma instância do objeto e atribui os valores às propriedades
            //$stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\\Model\\Usuario');
            $stmt->bindParam(1, $login, \PDO::PARAM_STR);
            $stmt->execute();

            $usuario = NULL;

            if ($stmt->rowCount() > 0) {
                $usuario = $stmt->fetch();
            }

            return $usuario;
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

    public function busca($id)
    {
        try {
            $sql = "SELECT * FROM usuario WHERE id = ?";
            $stmt = $this->conexao->prepare($sql);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, '\\Model\\Usuario');
            $stmt->bindParam(1, $id, \PDO::PARAM_INT);
            $stmt->execute();

            $usuario = new \Model\Usuario();

            if ($stmt->rowCount() > 0) {
                $usuario = $stmt->fetch();
            }
            return $usuario;
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

    public function buscaPorNome($nome)
    {
        $nome = str_replace('-', ' ', $nome);
        $usuarios = null;
        
        try {
            $sql = "SELECT * FROM usuario WHERE nome_completo LIKE ?";
            $stmt = $this->conexao->prepare($sql);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, '\\Model\\Usuario');
            $stmt->bindValue(1, "%$nome%", \PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $usuarios = array();

                while ($usuario = $stmt->fetch()) {
                    array_push($usuarios, $usuario);
                }

                return $usuarios;
            }
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

    public function lista()
    {
        $usuarios = null;
        
        try {

            $sql = "SELECT * FROM usuario";
            $stmt = $this->conexao->query($sql);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, '\\Model\\Usuario');

            if ($stmt->rowCount() > 0) {
                $usuarios = array();

                while ($usuario = $stmt->fetch()) {
                    array_push($usuarios, $usuario);
                }
                return $usuarios;
            }
        } catch (\PDOException $exception) {
            echo $exception->getMesssage();
        }
    }

    public function exclui($usuario)
    {
        $id = $usuario->getId();

        try {
            $sql = "DELETE FROM usuario WHERE id = ?";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $id, \PDO::PARAM_INT);
            $stmt->execute();
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

    public function insere($usuario)
    {
        try {

            $sql = "INSERT INTO usuario (id_condominio, nome_completo, email, apto, bloco, dt_hr_cadastro, id_permissao ) VALUES ";
            $sql = $sql . "(?, ?, ?, ?, ?, now(), ?) ";

            $idCondominio = $usuario->getIdCondominio();
            $nome = $usuario->getNomeCompleto();
            $email = $usuario->getEmail();
            $apto = $usuario->getApto();
            $bloco = $usuario->getBloco();
            $idRole = $usuario->getIdRole();

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $idCondominio, \PDO::PARAM_INT);
            $stmt->bindParam(2, $nome, \PDO::PARAM_STR);
            $stmt->bindParam(3, $email, \PDO::PARAM_STR);
            $stmt->bindParam(4, $apto, \PDO::PARAM_STR);
            $stmt->bindParam(5, $bloco, \PDO::PARAM_STR);
            $stmt->bindParam(6, $idRole, \PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

    public function atualiza($usuario)
    {
        try {

            $sql = " UPDATE usuario SET nome_completo = ?, email = ?, apto = ?, ";
            $sql = $sql . " bloco = ?, id_permissao = ? WHERE id = ? ";

            $nome = $usuario->getNomeCompleto();
            $email = $usuario->getEmail();
            $apto = $usuario->getApto();
            $bloco = $usuario->getBloco();
            $idRole = $usuario->getIdRole();
            $id = $usuario->getId();

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $nome, \PDO::PARAM_STR);
            $stmt->bindParam(2, $email, \PDO::PARAM_STR);
            $stmt->bindParam(3, $apto, \PDO::PARAM_STR);
            $stmt->bindParam(4, $bloco, \PDO::PARAM_STR);
            $stmt->bindParam(5, $id, \PDO::PARAM_STR);
            $stmt->bindParam(6, $idRole, \PDO::PARAM_INT);

            return $stmt->execute();
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

}
