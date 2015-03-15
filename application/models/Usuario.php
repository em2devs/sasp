<?php

namespace Model;

class Usuario
{

    private $id;
    private $id_condominio;
    private $nome_completo;
    private $email;
    private $login;
    private $senha;
    private $apto;
    private $bloco;
    private $dt_hr_cadastro;
    private $dt_hr_ultimo_login;
    private $id_role;
    
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setIdCondominio($idCondominio)
    {
        $this->id_condominio = $idCondominio;
    }

    public function setNomeCompleto($nomeCompleto)
    {
        //$this->nome_completo = strtoupper($nomeCompleto);
        $this->nome_completo = $nomeCompleto;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function setSenha($senha)
    {
        $this->senha = password_hash($senha, PASSWORD_DEFAULT);
    }

    public function setApto($apto)
    {
        $this->apto = $apto;
    }

    public function setBloco($bloco)
    {
        $this->bloco = $bloco;
    }

    public function setDataHoraCadastro($dtHoraCadastro)
    {
        $this->dt_hr_cadastro = $dtHoraCadastro;
    }

    public function setDataHoraUltimoLogin($dtHoraUltimoLogin)
    {
        $this->dt_hr_ultimo_login = $dtHoraUltimoLogin;
    }

    public function setIdRole($idRole)
    {
        $this->id_role = $idRole;
    }

    public function getNomeCompleto()
    {
        return $this->nome_completo;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function getApto()
    {
        return $this->apto;
    }

    public function getBloco()
    {
        return $this->bloco;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdCondominio()
    {
        return $this->id_condominio;
    }

    public function getDtHrUltimoLogin()
    {
        return $this->dt_hr_ultimo_login;
    }

    public function getDtHrCadastro()
    {
        return $this->dt_hr_cadastro;
    }

    public function getIdRole()
    {
        return $this->id_role;
    }

}
