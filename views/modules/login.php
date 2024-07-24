<div class="sufee-login d-flex align-content-center flex-wrap">
    <div class="container">
        <div class="login-content">
            <div class="login-logo">
                <a href="inicio">
                    <img class="align-content" src="views/img/template/logo.jpg" alt="">
                </a>
            </div>
            <div class="login-form">
                <form method="post">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="ingemail" name="ingemail" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="password" id="ingpassword" name="ingpassword" class="form-control" placeholder="Contraseña">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Recuerdame
                        </label>
                        <label class="pull-right">
                            <a href="#">Olvidó su contraseña</a>
                        </label>

                    </div>
                    <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Iniciar sesión</button>
                    <?php 
                    $login = new ControladorAdministrador();
                    $login->ctrAdministrador();
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>