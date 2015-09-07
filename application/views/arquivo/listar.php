<?php $role = \Lib\Session::get('role'); ?>

<h3>Lista de Arquivos</h3>

<?php if ($role == 1): ?>
    <a class="btn btn-primary" href="<?= URL . 'arquivo/upload'; ?>">Inserir</a>
    <a class="btn btn-primary" href="<?= URL . 'tipo-arquivo/cadastrar'; ?>">Inserir Tipo de Arquivo</a>
<?php endif; ?>
<br><br>

<table class="table table-striped table-bordered">
    <tr>
        <th>Condomínio</th>
        <th>Descrição</th>
        <th>Arquivo</th>
        <?php if ($role < 3): ?>
            <th>Ações</th>
        <?php endif; ?>
    </tr>

    <?php if (sizeof($data['arquivos']) > 0): ?>
        <?php foreach ($data['arquivos'] as $arquivo): ?>
            <tr>
                <td>
                    <?php if ($arquivo->getIdCondominio() > 0): ?>
                        <?= $arquivo->getCondominio()->getNome(); ?>
                    <?php else: ?>
                        <?= "-" ?>
                    <?php endif; ?>
                </td>
                
                <td>
                    <?= $arquivo->getNomeExibicao(); ?>
                </td>
                
                <td>
                    <?= $arquivo->getNome(); ?>
                </td>
                
                <td>
                    <a class="btn btn-primary" href="<?= URL . 'arquivo/download/' . $arquivo->getId(); ?>" ><span class="glyphicon glyphicon-download-alt"></span> Download</a>
                    <?php if ($role == 1): ?>
                        <a class="btn btn-danger" href="<?= URL . 'arquivo/excluir/' . $arquivo->getId(); ?>" ><span class="glyphicon glyphicon-remove"></span> Excluir</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>