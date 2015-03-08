<?php

namespace Model;

class Condominio
{

    private $id;
    private $nome;
    private $cep;
    private $endereco_tipo;
    private $endereco_nome;
    private $endereco_numero;
    private $qtd_aptos;
    private $qtd_blocos;
    private $dt_hr_cadastro;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    public function getEnderecoTipo()
    {
        return $this->endereco_tipo;
    }

    public function setEnderecoTipo($enderecoTipo)
    {
        $this->endereco_tipo = $enderecoTipo;
    }

    public function getEnderecoNome()
    {
        return $this->endereco_nome;
    }

    public function setEnderecoNome($enderecoNome)
    {
        $this->endereco_nome = $enderecoNome;
    }

    public function getEnderecoNumero()
    {
        return $this->endereco_numero;
    }

    public function setEnderecoNumero($enderecoNumero)
    {
        $this->endereco_numero = $enderecoNumero;
    }

    public function getQuantidadeAptos()
    {
        return $this->qtd_aptos;
    }

    public function setQuantidadeAptos($quantidadeAptos)
    {
        $this->qtd_aptos = $quantidadeAptos;
    }

    public function getQuantidadeBlocos()
    {
        return $this->qtd_blocos;
    }

    public function setQuantidadeBlocos($quantidadeBlocos)
    {
        $this->qtd_blocos = $quantidadeBlocos;
    }

    public function getDataHoraCadastro()
    {
        return $this->dt_hr_cadastro;
    }

    public function setDataHoraCadastro($dataHoraCadastro)
    {
        $this->dt_hr_cadastro = $dataHoraCadastro;
    }

}
