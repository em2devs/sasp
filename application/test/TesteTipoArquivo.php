<?php

$tipoArquivo = new \Model\TipoArquivo();
$tipoArquivo->setNome("EXCEL");

$dao = new \Model\TipoArquivoDao();
$dao->insere($tipoArquivo);

