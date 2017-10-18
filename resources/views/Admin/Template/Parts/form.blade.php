  <div class="row" id="estilo_formulario">

      <div class="row">
        <div class="input-field col s10">
          <input placeholder="John Smith" name='name' type="text" class="validate" required="">
          <label>Nombre Completo</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s10">
          <input placeholder="example@hotmail.com" name='email' type="email" class="validate" required="">
          <label>Email</label>
        </div>
      </div>


      <div class="row">
        <div class="input-field col s10">
          <input placeholder="***********" name='password' type="password" class="validate" required="">
          <label>Password</label>
        </div>
      </div>

      <select class="browser-default col s10" name='type'>
        <option value="" disabled selected>Seleccione una opcion</option>
        <option value="member" name="type">Miembro</option>
        <option value="admin" name="type">Administrador</option>
      </select>

      <div class="row">
        <div class="input-field col s10">
          <input type="file" name="avatar" id="avatar">
        </div>
      </div>

      <button class="btn waves-effect waves-light" id="alinea_boton" type="submit">Enviar
        <i class="material-icons right">send</i>
      </button>

  </div>

  <script type="text/javascript">
    $(document).ready(function() {
      $('select').material_select();
    });
  </script>