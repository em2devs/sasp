<?php

namespace Model;

class Arquivo
{

    private $id;
    private $id_usuario_upload;
    private $id_tipo_arquivo;
    private $nome;
    private $dt_hr_upload;
    private $nome_exibicao;
    private $id_condominio;
    protected $condominio;

    public function getId()
    {
        return $this->id;
    }

    public function getIdCondominio()
    {
        return $this->id_condominio;    
    }

    public function getIdUsuarioUpload()
    {
        return $this->id_usuario_upload;
    }

    public function getIdTipoArquivo()
    {
        return $this->id_tipo_arquivo;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getDataHoraUpload()
    {
        return $this->dt_hr_upload;
    }

    public function getNomeExibicao()
    {
        return $this->nome_exibicao;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setIdCondominio($idCondominio)
    {
        $this->id_condominio = $idCondominio;
    }

    public function setIdUsuarioUpload($idUsuario)
    {
        $this->id_usuario_upload = $idUsuario;
    }

    public function setIdTipoArquivo($tipoArquivo)
    {
        $this->id_tipo_arquivo = $tipoArquivo;
    }

    public function setNomeExibicao($nomeExibicao)
    {
        $this->nome_exibicao = $nomeExibicao;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setDataHoraUpload($dataHoraUpload)
    {
        $this->dt_hr_upload = $dataHoraUpload;
    }
    
    public function validarMimeType($mimeType)
    {
        $haystack = array(
            "image/jpeg",
            "image/pjpeg",
            "image/png",
            "image/gif",
            "application/pdf",
            "application/zip",
            "application/msword",
            "application/mspowerpoint",
            "application/powerpoint",
            "application/vnd.ms-powerpoint",
            "application/x-mspowerpoint",
            "application/vnd.ms-excel",
            "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            "application/vnd.ms-powerpoint",
            "application/vnd.openxmlformats-officedocument.presentationml.presentation",
            "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
            "text/csv",
        );
        
        if (in_array($mimeType, $haystack)) {
            return true;
        } else {
            return false;
        }
    }

    public function getCondominio()
    {
        $condominioDao = new \Model\Dao\CondominioDao();
        $condominio = $condominioDao->busca($this->id_condominio);
        
        return $condominio;
    }
}
