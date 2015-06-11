<h3>Lista de Arquivos</h3>

<a class="btn btn-primary" href="<?= URL . 'arquivo/upload'; ?>">Inserir</a>
<a class="btn btn-primary" href="<?= URL . 'tipo-arquivo/cadastrar'; ?>">Inserir Tipo de Arquivo</a>
<br><br>

<table class="table table-striped table-bordered">
    <tr>
        <th>Condomínio</th>
        <th>Descrição</th>
        <th>Arquivo</th>
        <?php $role = \Lib\Session::get('role'); ?>
        <?php if ($role < 3): ?>
            <th>Ações</th>
        <?php endif; ?>
    </tr>

    <?php if (sizeof($data['arquivos']) > 0): ?>
        <?php foreach ($data['arquivos'] as $arquivo): ?>
            <tr>
                <td>
                    <?= $arquivo->getCondominio()->getNome(); ?>
                </td>
                
                <td>
                    <?= $arquivo->getNomeExibicao(); ?>
                </td>
                
                <td>
                    <?= $arquivo->getNome(); ?>
                </td>

                <?php if ($role < 3): ?>
                    <td>
                        <a class="btn btn-primary" href="<?= URL . 'arquivo/download/' . $arquivo->getId(); ?>" ><span class="glyphicon glyphicon-download-alt"></span> Download</a>
                        <a class="btn btn-danger" href="<?= URL . 'arquivo/excluir/' . $arquivo->getId(); ?>" ><span class="glyphicon glyphicon-remove"></span> Excluir</a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>