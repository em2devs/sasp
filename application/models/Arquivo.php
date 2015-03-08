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

    public function getId()
    {
        return $this->id;
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

}
