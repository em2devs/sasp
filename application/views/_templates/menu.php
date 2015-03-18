<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?= URL . 'sistema/login'; ?>">SASP</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <?php if (\Lib\Session::get('user_logged_in')): ?>
                <?= $this->montaMenu(); ?>
            <?php endif; ?>

            <ul class="nav navbar-nav pull-right">
            <?php if (\Lib\Session::get('nome') !== null): ?>
                <li><a href="<?= URL . 'usuario/editar/' . \Lib\Session::get('id'); ?>"><?= \Lib\Session::get('nome'); ?></a></li>
                <li><a href="<?= URL . 'sistema/logoff'; ?>">Logoff</a></li>
            <?php else: ?>
                <li><a href="<?= URL . 'sistema/login'; ?>">Login</a></li>
            <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>