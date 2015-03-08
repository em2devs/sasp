<?php

namespace Lib;

class ConexaoFactory
{

    public function getConexao()
    {
        try {
            $dsn = DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
            $driver_options = array(
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ);
            $conexao = new \PDO($dsn, DB_USER, DB_PASS, $driver_options);
            return $conexao;
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

}
