<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login Template</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="https://source.unsplash.com/sfL_QOnmy00/1600x900" alt="login" class="login-card-img">

          </div>
          <div class="col-md-7">
            <div class="card-body">
              <div class="brand-wrapper">
                <img src="assets/images/logo.svg" alt="logo" class="logo">
              </div>
              <p class="login-card-description">Ingresa a tu cuenta</p>
              <form name="form-ingreso" id="form-ingreso" method="POST">
                  <div class="form-group">
                    <label for="email" class="sr-only">Email</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="Dirección de Email" autocomplete="off">
                  </div>
                  <div class="form-group mb-4">
                    <label for="password" class="sr-only">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="***********">
                  </div>
                  <!--<input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Login">-->
                  <button type="button" id="btnFetch" class="btn btn-block login-btn mb-4">Ingresar</button>
                </form>
                <a href="#!" class="forgot-password-link">Olvidaste tu Contraseña?</a>
                <p class="login-card-footer-text">No tienes una cuenta? <a href="#!" class="text-reset">Registrate Ahora!</a></p>
                <nav class="login-card-footer-nav">
                  <a href="#!">Terminos de Uso.</a>
                  </br>
                  <a href="#!">Derechos Reservados. Reboot 2021</a>
                </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
<script>
  $(document).ready(function() {
    $("#btnFetch").click(function() {
      nombreUsuario = document.getElementById("email").value;
      passwordUsuario = document.getElementById("password").value
      formData = new FormData();
      formData.append("nombreUsuario", nombreUsuario);
      formData.append("passwordUsuario", passwordUsuario);
      $.ajax({
        url: "html/application/consultas/login.php",
        method: "POST", 
        data: formData,
        contentType: false, 
        cache: false, 
        processData: false,
        beforeSend: function(){
          // disable button
          $("#btnFetch").prop("disabled", true);
          // add spinner to button
          $("#btnFetch").html(
            `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...`
          );
        }, 
        success: function(data){
          //console.log(data);
          resultado = JSON.parse(data);
          item = resultado['item'];
          mensaje = resultado['mensaje'];

          if(typeof item === 'undefined'){
            alert("Usuario y/o contraseña invalidos");
          }else{
            elemento = item[0];
            idLogin = elemento['idLogin'];
            idUsuario = elemento['idUsuario'];
            idPerfil = elemento['idPerfil'];
            estado = elemento['estado'];

            if(estado != 1){
              alert("Usuario inactivo");
            }else{
              
              formData_Perfil = new FormData();
              formData_Perfil.append("idPerfil", idPerfil);

              $.ajax({
                url: "html/application/consultas/permisos.php",
                method: "POST",
                data: formData_Perfil,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data){
                  resultado = JSON.parse(data);
                  item = resultado['item'];
                  mensaje = resultado['mensaje'];

                  let permisos = [];

                  if(typeof item === 'undefined'){
                    alert("Ha ocurrido un problema, por favor contactese con el administrador");
                  }else{
                    for(i = 0; i<item.length; i++){
                      elemento = item[i];
                      idPermiso = elemento['idPermiso'];

                      permisos.push(idPermiso);
                    }

                    formData_sesion = new FormData();

                    formData_sesion.append("idLogin", idLogin);
                    formData_sesion.append("idUsuario", idUsuario);
                    formData_sesion.append("idPerfil", idPerfil);
                    formData_sesion.append("estado", estado);
                    formData_sesion.append("permisos", permisos);

                    $.ajax({
                      url: "html/application/consultas/sesion.php",
                      method: "POST",
                      data: formData_sesion,
                      contentType: false,
                      cache: false, 
                      processData: false,
                      success: function(data){

                        formData_guardado = new FormData();
                        formData_guardado.append("idUsuario", idUsuario);

                        $.ajax({
                          url: "html/application/consultas/guardadoLogin.php",
                          method: "POST",
                          data: formData_guardado,
                          contentType: false,
                          cache: false,
                          processData: false,
                          success: function(data){
                            $("#btnFetch").prop("disabled", false);
                            $("#btnFetch").html(
                              `Bienvenid@`
                            );
                            window.location=("html/pages/dashboard.php");
                          }
                        })
                      }
                    })
                  }
                }
              })
            }
          }
        }
      })
    });
  });
</script>