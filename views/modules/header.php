<!-- Header-->
<header id="header" class="header">
    <div class="top-left">
        <div class="navbar-header">
            <a class="navbar-brand" href="inicio"><img src="views/img/template/logo.jpg" alt="Logo"></a>
            <a class="navbar-brand hidden" href="inicio"><img src="views/img/template/icon.png" alt="Logo"></a>
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
        </div>
    </div>
    <div class="top-right">
        <div class="header-menu">
            <div class="dropdown"><span><?= $_SESSION['nombre'] ?></span></div>
            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php 
                    if ($_SESSION['foto'] == '')
                        $user_img = 'default/anonymous.png';
                    else 
                        $user_img = $_SESSION['foto'];
                    ?>
                    <img class="user-avatar rounded-circle" src="views/img/perfil/<?=$user_img?>" alt="User Avatar">
                </a>
                <div class="user-menu dropdown-menu">
                    <a class="nav-link" href="perfil"><i class="fa fa-user"></i>Perfil</a>
                    <a class="nav-link" href="logout"><i class="fa fa-power-off"></i>Salir</a>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- /#header -->