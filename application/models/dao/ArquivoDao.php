<?php

namespace Model\Dao;

class ArquivoDao extends \Core\Dao
{

    public function __construct()
    {
        parent::__construct();
    }

    public function lista($idCondominio = null)
    {
        try {

            if ($idCondominio != null) {
                $sql = "SELECT * FROM arquivo WHERE id_condominio = 0 OR id_condominio = {$idCondominio}";
            }  else {
                $sql = "SELECT * FROM arquivo";
            }
            
            $stmt = $this->conexao->query($sql);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, '\\Model\\Arquivo');

            //$stmt->bindParam(1, $idCondominio, \PDO::PARAM_INT);            
            //if ($stmt->rowCount() > 0) {
            
            $arquivos = array();

            while ($arquivo = $stmt->fetch()) {
                array_push($arquivos, $arquivo);
            }

            return $arquivos;
            //}
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

    public function busca($id)
    {
        try {
            $sql = "SELECT * FROM arquivo WHERE id = ?";
            $stmt = $this->conexao->prepare($sql);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, '\\Model\\Arquivo');
            $stmt->bindParam(1, $id, \PDO::PARAM_INT);
            $stmt->execute();

            $arquivo = new \Model\TipoArquivo();

            if ($stmt->rowCount() > 0) {
                $arquivo = $stmt->fetch();
            }
            return $arquivo;
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

    public function buscaPorNome($nome, $idCondominio = null)
    {
        $nome = str_replace('-', ' ', $nome);
        $arquivos = null;
        
        try {
            $sql = "SELECT * FROM arquivo WHERE nome LIKE ?";
            
            if ($idCondominio !== null) {
                $sql .= " AND id_condominio = ?";
            }
            
            $stmt = $this->conexao->prepare($sql);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, '\\Model\\Arquivo');
            $stmt->bindValue(1, "%$nome%", \PDO::PARAM_STR);
            
            if ($idCondominio !== null) {
                $stmt->bindValue(2, $idCondominio, \PDO::PARAM_STR);
            }
            
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $arquivos = array();

                while ($arquivo = $stmt->fetch()) {
                    array_push($arquivos, $arquivo);
                }

                return $arquivos;
            }
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

    public function insere($arquivo)
    {
        try {
            $sql = "INSERT INTO arquivo (id_usuario_upload, id_tipo_arquivo, nome, nome_exibicao";
            $sql = $sql . ", dt_hr_upload, id_condominio) VALUES (?,?,?,?, NOW(), ?) ";

            $idUsuarioUpload = $arquivo->getIdUsuarioUpload();
            $idTipoArquivo = $arquivo->getIdTipoArquivo();
            $nome = $arquivo->getNome();
            $nomeExibicao = $arquivo->getNomeExibicao();
            $idCondominio = $arquivo->getIdCondominio();

            $stmt = $this->conexao->prepare($sql);

            $stmt->bindParam(1, $idUsuarioUpload, \PDO::PARAM_INT);
            $stmt->bindParam(2, $idTipoArquivo, \PDO::PARAM_INT);
            $stmt->bindParam(3, $nome, \PDO::PARAM_STR);
            $stmt->bindParam(4, $nomeExibicao, \PDO::PARAM_STR);
            $stmt->bindParam(5, $idCondominio, \PDO::PARAM_INT);

            return $stmt->execute();
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

    public function exclui(\Model\Arquivo $arquivo)
    {
        $id = $arquivo->getId();

        try {
            $sql = "SELECT * FROM arquivo WHERE id = ?";
            $stmt = $this->conexao->prepare($sql);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, '\\Model\\Arquivo');
            $stmt->bindParam(1, $id, \PDO::PARAM_INT);
            $stmt->execute();
            $arquivo = $stmt->fetch();
            unlink('public/files/sistema/' . $arquivo->getNome());
            
            $sql = "DELETE FROM arquivo WHERE id = ?";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $id, \PDO::PARAM_INT);
            $stmt->execute();
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }
}
