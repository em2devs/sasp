<h3>Busca de Usuários</h3>

<div class="form-inline">
    <div class="form-group">
        <div class="input-group">
            <input type="text" class="form-control" id="busca" name="buscaUsuario" value="<?= $data['nome']; ?>">
            <div class="input-group-btn">
                <button type="button" id="buscar" value="Buscar" class="btn btn-default">
                    <span class="glyphicon glyphicon-search"></span> Buscar
                </button>
            </div>
        </div>
    </div>
</div>

<div id="usuarios"></div>

<script>
    $(document).ready(function() {
        $().ajaxError(function( event, request, settings ) {
            $( "#msg" ).append( "<li>Error requesting page " + settings.url + "</li>" );
        });
        
        $("#buscar").click(function() {
            $.get("<?= URL; ?>usuario/listar/" + $("#busca").val())
                .done(function(data) {
                    $("#usuarios").html(data);
                });
        });
        
        $("#buscar").click().click();
    });
</script>