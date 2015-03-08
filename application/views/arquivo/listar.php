<h3>Lista de Arquivos</h3>

<a class="btn btn-primary" href="<?= URL . 'arquivo/upload'; ?>">Inserir</a>
<a class="btn btn-primary" href="<?= URL . 'tipo-arquivo/cadastrar'; ?>">Inserir Tipo de Arquivo</a>
<br><br>

<table class="table table-striped table-bordered">
    <tr>
        <th>Descrição</th> 
        <th>Arquivo</th>  
        <th>Ações</th>
    </tr>

    <?php if (sizeof($data['arquivos']) > 0): ?>
        <?php foreach ($data['arquivos'] as $arquivo): ?>
            <tr>
                <td><?= $arquivo->getNomeExibicao() ?></td>
                <td>
                    <?= '<a href ="' . PATH_FILES . '/' . $arquivo->getNome() . '">' . $arquivo->getNome() . '</a>' ?>
                </td>
                <td>
                    <a class="btn btn-danger"  href="<?= URL . 'arquivo/excluir/' . $arquivo->getId(); ?>">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>