<h3>Busca de Condomínios</h3>

<input type="text" id="busca" name="buscaCondomino">
<button type="button" value="Buscar" class="btn btn-default" onclick="busca()">
    <span class="glyphicon glyphicon-search"></span> Buscar
</button> <br>

<a class="btn btn-primary" href="<?= URL . 'condominio/cadastrar'; ?>">Inserir</a>
<br><br>

<div id="condominios"></div>

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
                document.getElementById("condominios").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "<?= URL; ?>condominio/listar/" + textoBusca, true);
        xmlhttp.send();
    }
    window.onload = busca();
</script>