<?php

namespace Model\Dao;

class ArquivoDao extends \Core\Dao
{

    public function __construct()
    {
        parent::__construct();
    }

    public function lista($idCondominio)
    {
        $arquivos = null;
        
        try {

            if ($idCondominio != null && $idCondominio != 0)
            {
                $sql = "SELECT * FROM arquivo WHERE id_condominio = " . $idCondominio;               
            } 
            else
            {
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

}
