<?php

/* $usuario = new Usuario();
  $usuario->setIdCondominio(1);
  $usuario->setNome("Fredenesio");
  $usuario->setEmail("huehue.mail.com");
  $usuario->setApto("12345");
  $usuario->setBloco("B10");

  $usuarioDao = new UsuarioDao();
  $usuarioDao->insere($usuario);

  $usuario->setId(6);
  $usuario->setNome("Wario");

  $usuarioDao->atualiza($usuario); */

$usuarioDao = new \Model\Dao\UsuarioDao();
$usuario = $usuarioDao->busca(6);

print_r($usuario);

$usuarioDao->exclui($usuario);
