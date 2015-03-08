<h3>Cadastro de Condomínio</h3>

<form class="form-horizontal" role="form" method="post" action="<?= $data['formAction']; ?>">
    <div class="form-group">
        <label class="control-label col-sm-2" for="inputNome" >Nome</label>
        <div class="col-sm-4">
            <input class="form-control" type="text" id="inputNome" name="nome">
        </div>			
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2" for="inputCep" >Cep</label>
        <div class="col-sm-2">
            <input class="form-control" type="text" id="inputCep" name="cep">
        </div>			
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2" for="inputEnderecoTipo" >Tipo Endereco</label>
        <div class="col-sm-2">
            <input class="form-control"  type="text" id="inputEnderecoTipo" name="endereco_tipo">
        </div>			
    </div>
    
    <div class="form-group">
        <label class="control-label col-sm-2" for="inputEndereco" >Endereco</label>
        <div class="col-sm-6">
            <input class="form-control" type="text" id="inputEndereco" name="endereco_nome">
        </div>			
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2" for="inputNumero" >Numero</label>
        <div class="col-sm-1">
            <input class="form-control" type="text" id="inputNumero" name="endereco_numero">
        </div>			
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2" for="inputQtdeApto" >Quantidade Aptos</label>
        <div class="col-sm-1">
            <input class="form-control" type="text" id="inputQtdeApto" name="qtde_apto">
        </div>			
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2" for="inputQtdeBlocos" >Quantidade Blocos</label>
        <div class="col-sm-1">
            <input class="form-control" type="text" id="inputQtdeBlocos" name="qtde_blocos">
        </div>			
    </div> <br>
    
    <input class="btn btn-primary" type="submit" value="Enviar">
</form>