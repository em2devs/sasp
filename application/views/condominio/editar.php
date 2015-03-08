<h3>Alteração de dados de condomínio</h3>

<form class ="form-horizontal" method="post" action="<?= $data['formAction']; ?>">
    <div class="control-group">
        <label class="control-label" for="inputNome" >Nome</label>
        <div class="controls" >
            <input type="text" id="inputNome" name="nome" value="<?= $data['condominio']->getNome() ?>">
        </div>			
    </div>

    <div class="control-group">
        <label class="control-label" for="inputCep" >Cep</label>
        <div  class="controls">
            <input type="text" id="inputCep" name="cep" value="<?= $data['condominio']->getCep() ?>">
        </div>			
    </div>

    <div class="control-group">
        <label class="control-label" for="inputEndereco" >Endereco</label>
        <div  class="controls">
            <input type="text" id="inputEndereco" name="endereco_nome" value="<?= $data['condominio']->getEnderecoNome() ?>">
        </div>			
    </div>

    <div class="control-group">
        <label class="control-label" for="inputNumero" >Numero</label>
        <div  class="controls">
            <input type="text" id="inputNumero" name="endereco_numero" value="<?= $data['condominio']->getEnderecoNumero() ?>">
        </div>			
    </div>

    <div class="control-group">
        <label class="control-label" for="inputEnderecoTipo" >Tipo Endereco</label>
        <div  class="controls">
            <input type="text" id="inputEnderecoTipo" name="endereco_tipo" value="<?= $data['condominio']->getEnderecoTipo() ?>">
        </div>			
    </div>

    <div class="control-group">
        <label class="control-label" for="inputQtdeApto" >Quantidade Aptos</label>
        <div  class="controls">
            <input type="text" id="inputQtdeApto" name="qtde_apto" value="<?= $data['condominio']->getQuantidadeAptos() ?>">
        </div>			
    </div>

    <div class="control-group">
        <label class="control-label" for="inputQtdeBlocos" >Quantidade Blocos</label>
        <div  class="controls">
            <input type="text" id="inputQtdeBlocos" name="qtde_blocos" value="<?= $data['condominio']->getQuantidadeBlocos() ?>">
        </div>			
    </div><br>

    <input type="hidden"  name="id" value="<?= $data['condominio']->getId() ?>" >
    <input type="submit" class="btn btn-primary" value="Enviar">
</form>