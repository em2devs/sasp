<style>
    .btn-file {
        position: relative;
        overflow: hidden;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        background: red;
        cursor: inherit;
        display: block;
    }
    input[readonly] {
        background-color: white !important;
        cursor: text !important;
    }
</style>

<h3>Upload de Arquivos</h3>

<form class="form-horizontal" method="post" role="form" enctype="multipart/form-data" action="<?= $data['formAction']; ?>">
    <div class="form-group">
        <label class="control-label col-sm-2" for="inputNomeExibicao" >Nome de Exibição</label>
        <div class="col-sm-4">
            <input class="form-control" type="text" id="inputNomeExibicao" name="nomeExibicao">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2" for="selectTipoArquivo">Tipo de Arquivo</label>
        <div class="col-sm-4">
            <select class="form-control" name="tipoArquivo">
            <?php foreach ($data['tiposArquivo'] as $tipoArquivo): ?>
                <option value="<?= $tipoArquivo->getId(); ?>"><?= $tipoArquivo->getNome(); ?></option>
            <?php endforeach; ?>
            </select>
        </div>			
    </div>
    
    <div class="input-group col-sm-4 col-sm-push-2">
        <span class="input-group-btn">
            <span class="btn btn-primary btn-file">
                Procurar <input type="file" id="arquivo" name="arquivo">
            </span>
        </span>
        <input type="text" class="form-control" readonly>
    </div> <br>
    
    <input type="submit" name="enviar" value="Enviar" class="btn btn-primary">
</form>

<script>
    $(document).on('change', '.btn-file :file', function () {
        var input = $(this),
                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });

    $(document).ready(function () {
        $('.btn-file :file').on('fileselect', function (event, numFiles, label) {

            var input = $(this).parents('.input-group').find(':text'),
                    log = numFiles > 1 ? numFiles + ' files selected' : label;

            if (input.length) {
                input.val(log);
            } else {
                if (log)
                    alert(log);
            }

        });
    });
</script>