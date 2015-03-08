<?php

namespace Core;

/**
 * Class Dao
 * 
 * Esta é a classe DAO "base".
 * Todos os outros DAOs "reais" herdam esta classe.
 */
class Dao
{

    protected $conexao;

    public function __construct()
    {
        try {
            $conexaoFactory = new \Lib\ConexaoFactory();
            $this->conexao = $conexaoFactory->getConexao();
        } catch (\PDOException $e) {
            $this->conexao = $e->getMessage();
        }
    }

}
