<h3>Lista de Tipos de Arquivo</h3>

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