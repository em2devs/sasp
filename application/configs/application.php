<?php

/**
 * Configurações
 */

/**
 * Configurações para: Relatório de erros
 * Útil para exibir todos os problemas possíveis em um ambiente de desenvolvimento.
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);
define('SECURE', FALSE);

/**
 * Configurações para: URL do projeto
 * Defina a URL completa do projeto para ser utilizada em links e referências
 */
define('URL', 'http://' . $_SERVER['SERVER_NAME'] . '/sasp/');

/**
 * Configurações para: Cookies
 */
require_once 'application/configs/cookies.php';

/**
 * Configurações para: Banco de dados
 */
require_once 'application/configs/db.php';

/**
 * Configurações para: Mensagens e Avisos de erro
 */
require_once 'application/configs/feedbacks.php';

/**
 * Configurações para: Aplicação
 */
require_once 'application/configs/paths.php';