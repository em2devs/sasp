<?php

//Teste: Instancia e utilização da classe
$condominio = new \Model\Condominio();
$condominio->setCep(12345678);
$condominio->setEnderecoNome("Rua do HUEHUE");
$condominio->setNome("Gibe Monie");
$condominio->setQuantidadeAptos(400);
$condominio->setEnderecoNumero(123245);
$condominio->setEnderecoTipo("Avenida");
$condominio->setQuantidadeBlocos(3);

//echo $condominio->getCep() . "<br>";
//echo $condominio->getEnderecoNome() . "<br>";
//echo $condominio->getEnderecoNumero() . "<br>";
//echo $condominio->getEnderecoTipo() . "<br>";
//echo $condominio->getNome() . "<br>";
//echo $condominio->getQuantidadeAptos() . "<br>";
//echo $condominio->getQuantidadeBlocos() . "<br>";

$condominioDao = new \Model\Dao\CondominioDao();
$condominioDao->insere($condominio);
//$condominios = $condominioDao->lista();

    //foreach($condominios as $novo_condominio){
    //    echo $novo_condominio->getNome() . "<br>";
    // }

    //$novo_condominio =  $condominioDao->busca(3);
    //$condominioDao->exclui($novo_condominio);

    //print_r($novo_condominio);
