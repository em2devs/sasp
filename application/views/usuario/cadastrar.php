<h3>Cadastro de Usuário</h3>

<form class="form-horizontal" role="form" method="post" action="<?= $data['formAction']; ?>">
    <div class="form-group">
        <label class="control-label col-sm-1" for="inputNome">Nome</label>
        <div class="col-sm-4">
            <input class="form-control" type="text" id="inputNome" name="nome" maxlength="50" required>
        </div>			
    </div>

    <div class="form-group">
        <label class="control-label col-sm-1" for="inputEmail">Email</label>
        <div class="col-sm-3">
            <input class="form-control" type="text" id="inputEmail" name="email" maxlength="50">
        </div>			
    </div>

    <div class="form-group">
        <label class="control-label col-sm-1" for="selectCondominio">Condominio</label>
        <div class="col-sm-3">
            <select class="form-control" name="condominio">
                <option value="0">Admin</option>
            <?php foreach ($data['condominios'] as $condominio): ?>
                <option value="<?= $condominio->getId(); ?>"><?= $condominio->getNome(); ?></option>
            <?php endforeach; ?>
            </select>
        </div>			
    </div>
    
    <div class="form-group">
        <label class="control-label col-sm-1" for="inputApartamento">Apartamento</label>
        <div class="col-sm-1">
            <input class="form-control" type="text" id="inputApartamento" name="apartamento" maxlength="10">
        </div>			
    </div>

    <div class="form-group">
        <label class="control-label col-sm-1" for="inputBloco">Bloco</label>
        <div class="col-sm-1">
            <input class="form-control" type="text" id="inputBloco" name="bloco" maxlength="50">
        </div>			
    </div>
    
    <div class="form-group">
        <label class="control-label col-sm-1" for="inputLogin">Login</label>
        <div class="col-sm-3">
            <input class="form-control" type="text" id="inputLogin" name="login" maxlength="20" required>
        </div>			
    </div>
    
    <div class="form-group">
        <label class="control-label col-sm-1" for="inputSenha">Senha</label>
        <div class="col-sm-3">
            <input class="form-control" type="password" id="inputSenha" name="senha" required>
        </div>			
    </div>
    
    <div class="form-group">
        <label class="control-label col-sm-1" for="selectRole">Role</label>
        <div class="col-sm-3">
            <select class="form-control" name="role">
            <?php foreach ($data['roles'] as $role): ?>
                <option value="<?= $role->getId(); ?>"><?= $role->getNome(); ?></option>
            <?php endforeach; ?>
            </select>
        </div>			
    </div> <br>
    
    <input class="btn btn-primary" type="submit" value="Enviar">
</form>