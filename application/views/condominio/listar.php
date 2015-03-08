<h3>Lista de Condomínios</h3>

<table class="table table-striped table-bordered">
    <tr>
        <th>Nome</th>
        <th>Qtde. Apartamentos</th>
        <th>Qtde. Blocos</th>
        <th>Acoes</th>
    </tr>

    <?php if (sizeof($data['condominios']) > 0): ?>
        <?php foreach ($data['condominios'] as $condominio): ?>
            <tr>
                <td><?= $condominio->getNome(); ?></td>
                <td><?= $condominio->getQuantidadeAptos(); ?></td>
                <td><?= $condominio->getQuantidadeBlocos(); ?></td>
                <td>
                    <a class="btn btn-info"    href="<?= URL . 'condominio/editar/' . $condominio->getId(); ?>">Editar</a>
                    <a class="btn btn-danger"  href="<?= URL . 'condominio/excluir/' . $condominio->getId(); ?>">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>