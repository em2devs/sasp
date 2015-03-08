<h3>Informe seu login e senha</h3>

<form class="form-horizontal" role="form" method="post" action="<?= $data['formAction']; ?>">

    <?php if ($data['mensagem'] !== ''): ?>
        <div class="alert alert-danger alert-dismissable col-sm-offset-1 col-sm-3">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?= $data['mensagem']; ?>
        </div>
        <div class="clearfix"></div>
    <?php endif; ?>

    <div class="form-group">
        <label for="inputLogin" class="col-sm-1 control-label">Login</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="inputLogin" name="login">
        </div>
    </div>

    <div class="form-group">
        <label for="inputSenha" class="col-sm-1 control-label">Senha</label>
        <div class="col-sm-3">
            <input type="password" class="form-control" id="inputSenha" name="senha">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-1 col-sm-11">
            <input type="submit" class="btn btn-primary" value="Enviar">
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        $(".close").click(function () {
            $(".alert").alert();
        });
        window.setTimeout(function () {
            $(".alert").fadeTo(1500, 0).slideUp(500, function () {
                $(this).alert("close");
            });
        }, 5000);
    });
</script>