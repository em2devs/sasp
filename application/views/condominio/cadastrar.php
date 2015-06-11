<h3>Cadastro de Condomínio</h3>

<form class="form-horizontal" role="form" method="post" action="<?= $data['formAction']; ?>">
    <div class="form-group">
        <label class="control-label col-sm-2" for="inputNome" >Nome</label>
        <div class="col-sm-4">
            <input class="form-control" type="text" id="inputNome" name="nome" maxlength="100" required>
        </div>			
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2" for="inputCep" >CEP</label>
        <div class="col-sm-2">
            <input class="form-control" type="text" id="inputCep" name="cep" maxlength="8" required>
        </div>			
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2" for="inputEnderecoTipo" >Tipo Endereco</label>
        <div class="col-sm-2">
            <input class="form-control"  type="text" id="inputEnderecoTipo" name="endereco_tipo" maxlength="20" required>
        </div>			
    </div>
    
    <div class="form-group">
        <label class="control-label col-sm-2" for="inputEndereco" >Endereco</label>
        <div class="col-sm-6">
            <input class="form-control" type="text" id="inputEndereco" name="endereco_nome" maxlength="100" required>
        </div>			
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2" for="inputNumero" >Numero</label>
        <div class="col-sm-1">
            <input class="form-control" type="text" id="inputNumero" name="endereco_numero" maxlength="10" required>
        </div>			
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2" for="inputQtdeApto" >Quantidade Aptos</label>
        <div class="col-sm-1">
            <input class="form-control" type="text" id="inputQtdeApto" name="qtde_apto" maxlength="10" required>
        </div>			
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2" for="inputQtdeBlocos" >Quantidade Blocos</label>
        <div class="col-sm-1">
            <input class="form-control" type="text" id="inputQtdeBlocos" name="qtde_blocos" maxlength="10" required>
        </div>			
    </div> <br>
    
    <input class="btn btn-primary" type="submit" value="Enviar">
</form>

<script>
$(document).ready(function() {
    
    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#inputEnderecoTipo").val("");
        $("#inputEndereco").val("");
    }
            
    //Quando o campo cep perde o foco.
    $("#inputCep").blur(function() {

        //Nova variável com valor do campo "cep".
        var cep = $(this).val();

        //Verifica se campo cep possui valor informado.
        if (cep !== "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{5}-?[0-9]{3}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#inputEnderecoTipo").val("...")
                $("#inputEndereco").val("...")

                // Consulta o webservice viacep.com.br
                $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#inputEnderecoTipo").val(dados.logradouro.split(' ')[0]);
                        $("#inputEndereco").val(dados.logradouro.split(' ').slice(1).join(' '));
                    }
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            }
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        }
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
});
</script>