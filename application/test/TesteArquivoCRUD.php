<?php

$arquivo = new \Model\Arquivo();
$arquivo->setIdUsuarioUpload(1);
$arquivo->setIdTipoArquivo(1);
$arquivo->setNome('Relação de dividendos.doc');

$dao = new \Model\Dao\ArquivoDao();
$dao->insere($arquivo);
