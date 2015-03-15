<h3>Busca de Arquivos</h3>

<div class="form-inline">
    <div class="form-group">
        <div class="input-group">
            <input type="text" class="form-control" id="busca" name="buscaArquivo" value="<?= $data['nome']; ?>">
            <div class="input-group-btn">
                <button type="button" value="Buscar" onclick="busca()" class="btn btn-default">
                    <span class="glyphicon glyphicon-search"></span> Buscar
                </button>
            </div>
        </div>
    </div>
</div>

<div id="arquivos"></div>

<script>
    function busca() {
        var textoBusca = document.getElementById("busca").value;

        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("arquivos").innerHTML = xmlhttp.responseText;
            }
        }
        textoBusca = textoBusca.replace(/ /g, "-");
        xmlhttp.open("GET", "<?= URL; ?>arquivo/listar/" + textoBusca, true);
        xmlhttp.send();
    }
    window.onload = busca();
</script>