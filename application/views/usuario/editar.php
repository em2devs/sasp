<h3>Alteração de dados do usuário</h3>

<form class="form-horizontal" role="form" method="post" action="<?= $data['formAction']; ?>">

    <div class="form-group">
        <label class="control-label col-sm-1" for="inputNome" >Nome</label>
        <div class="col-sm-4">
            <input class="form-control" type="text" id="inputNome" name="nome" value="<?= $data['usuario']->getNomeCompleto() ?>">
        </div>			
    </div>

    <div class="form-group">
        <label class="control-label col-sm-1" for="inputEmail" >Email</label>
        <div  class="col-sm-3">
            <input class="form-control" type="text" id="inputEmail" name="email" value="<?= $data['usuario']->getEmail() ?>">
        </div>			
    </div>

    <div class="form-group">
        <label class="control-label col-sm-1" for="selectCondominio">Condominio</label>
        <div class="col-sm-3">
            <select class="form-control" name="condominio">
                <?php foreach ($data['condominios'] as $condominio): ?>
                    <?php if ($condominio->getId() == $data['usuario']->getIdCondominio()): ?>
                        <option value="<?= $condominio->getId(); ?>" selected><?= $condominio->getNome(); ?></option>
                    <?php else: ?>
                        <option value="<?= $condominio->getId(); ?>"><?= $condominio->getNome(); ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>			
    </div>

    <div class="form-group">
        <label class="control-label col-sm-1" for="inputApartamento" >Apartamento</label>
        <div class="col-sm-1">
            <input class="form-control" type="text" id="inputApartamento" name="apartamento" value="<?= $data['usuario']->getApto() ?>">
        </div>			
    </div>

    <div class="form-group">
        <label class="control-label col-sm-1" for="inputBloco" >Bloco</label>
        <div class="col-sm-1">
            <input class="form-control" type="text" id="inputBloco" name="bloco" value="<?= $data['usuario']->getBloco() ?>">
        </div>			
    </div> 
    
    <?php if ((int)\Lib\Session::get('role') === 1): ?>
    <div class="form-group">
        <label class="control-label col-sm-1" for="selectPermissao">Permissao</label>
        <div class="col-sm-3">
            <select class="form-control" name="permissao">
                <?php foreach ($data['permissoes'] as $permissao): ?>
                    <?php if ($permissao->getId() == $data['usuario']->getIdRole()): ?>
                        <option value="<?= $permissao->getId(); ?>" selected><?= $permissao->getNome(); ?></option>
                    <?php else: ?>
                        <option value="<?= $permissao->getId(); ?>"><?= $permissao->getNome(); ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>			
    </div>
    <?php endif; ?>
    
    <br>

    <input type="hidden" name="id" value="<?= $data['usuario']->getId() ?>" >
    <input type="submit" class="btn btn-primary">
</form>