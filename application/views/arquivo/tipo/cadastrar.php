<h3>Cadastro de Tipos de Arquivo</h3>

<form class="form-horizontal" role="form" method="post" action="<?= $data['formAction']; ?>">
    <div class="form-group">
        <label class="control-label col-sm-2" for="tipoArquivo">Tipo de Arquivo</label>
        <div class="col-sm-4">
            <input class="form-control" type="text" id="tipoArquivo" name="tipo_arquivo" maxlength="100" required>
        </div>			
    </div>
    <br>
    <input class="btn btn-primary" type="submit" value="Enviar">
</form> <br>

<table class="table table-striped table-bordered">
    <tr>
        <th>Id</th>
        <th>Nome</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($data['tiposArquivo'] as $tipoArquivo): ?>
        <tr>
            <td><?= $tipoArquivo->getId() ?></td>
            <td><?= $tipoArquivo->getNome() ?></td>
            <td>
                <a class="btn btn-danger"  href="<?= URL . 'tipo-arquivo/excluir/' . $tipoArquivo->getId(); ?>">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>