<div class="form-floating mb-3 text-black">
    <input type="password" class="form-control" required id="pswd" name="pswd" placeholder="**********">
    <label for="user">Contraseña actual</label>
</div>
<div class="form-floating mb-3 text-black">
    <input type="password" class="form-control" required id="new_pswd" placeholder="**********">
    <label for="pswd">Nueva contraseña</label>
</div>
<div class="form-floating mb-3 text-black">
    <input type="password" onblur="verificar_contraseña()" required class="form-control" id="conf_pswd" name="conf_pswd"
        placeholder="**********">
    <label for="pswd">Confirmar contraseña</label>
</div>