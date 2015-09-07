<h3>Lista de Usuários</h3>

<table class="table table-striped table-bordered">
    <tr>
        <th>Nome</th>
        <th>Condominio</th>
        <th>Apto</th>
        <th>Bloco</th>
        <th>Permissao</th>
        <th>Acoes</th>
    </tr>

    <?php if (sizeof($data['usuarios']) > 0): ?>
        <?php foreach ($data['usuarios'] as $usuario): ?>
            <tr>
                <td><?= $usuario->getNomeCompleto(); ?></td>
                <?php if($usuario->getCondominio() !== NULL && $usuario->getCondominio()->getNome() !== 'Admin'): ?>
                    <td><?= $usuario->getCondominio()->getNome(); ?></td>
                <?php else: ?>
                    <td><?= ""; ?></td>
                <?php endif; ?>
                <td><?= $usuario->getApto(); ?></td>
                <td><?= $usuario->getBloco(); ?></td>
                <td><?= $usuario->getRole()->getNome(); ?></td>
                <td>
                    <a class="btn btn-info"    href="<?= URL . 'usuario/editar/' . $usuario->getId(); ?>">Editar</a>
                    <a class="btn btn-danger"  href="<?= URL . 'usuario/excluir/' . $usuario->getId(); ?>">Excluir</a>
                </td>
            </tr>	
        <?php endforeach; ?>
    <?php endif; ?>
</table>