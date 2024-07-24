<?php
if ($_SESSION["perfil"] != "administrador") {
    echo '<script>window.location = "inicio";</script>';
    return;
}
?>

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Inicio</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="inicio">Inicio</a></li>
                            <li class="active">Administradores</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPerfil">
                            Nuevo Perfil
                        </button>
    
                        <div class="col-md-10">
                            <center><strong class="card-title">Tabla Administradores</strong></center>
                        </div>
                    </div>
                    <div class="card-body">
                        <table  class="table table-striped table-bordered tablaPerfiles" id="tablaPerfiles">
                            <thead>
                                <tr>
                                    <th style="width:10px">#</th>
                                    <th>Nombres</th>
                                    <th>Email</th>
                                    <th>Foto</th>
                                    <th>Perfil</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php   
                                $item  = null;
                                $valor = null;
                                $perfiles = ControladorAdministrador::ctrMostrarAdministrador($item, $valor);

                                foreach ($perfiles as $key => $value) {
                                    echo ' <tr>
                                        <td>' . ($key + 1) . '</td>
                                        <td>' . $value["nombre"] . '</td>
                                        <td>' . $value["email"] . '</td>';

                                    if ($value["foto"] != "") {
                                        echo '<td><img src="views/img/perfil/' . $value["foto"] . '" class="img-thumbnail" width="40px"></td>';
                                    } else {
                                        echo '<td><img src="views/img/perfil/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
                                    }

                                    echo '<td>' . $value["perfil"] . '</td>';

                                    if ($value["estado"] != 0) {
                                        echo '<td><button class="btn btn-success btn-xs btnActivar" idPerfil="' . $value["id"] 
                                            . '" estadoPerfil="0" id="btnActivar">Activado</button></td>';
                                    } else {
                                        echo '<td><button class="btn btn-danger btn-xs btnActivar" idPerfil="' . $value["id"] 
                                            . '" estadoPerfil="1">Desactivado</button></td>';
                                    }
                                    echo '<td>
                                    <div class="btn-group">
                                    <button class="btn btn-warning btnEditarPerfil" idPerfil="' . $value["id"] . '" 
                                    data-toggle="modal" data-target="#modalEditarPerfil">
                                    <i class="fa fa-pencil"></i></button>
                                    
                                    <button class="btn btn-danger btnEliminarPerfil" idPerfil="' . $value["id"] . '" 
                                    fotoPerfil="' . $value["foto"] . '"><i class="fa fa-times"></i></button>
                                    </div></td></tr>';
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->


<!--=====================================
MODAL AGREGAR ADMINISTRADOR
======================================-->
<div id="modalAgregarPerfil" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background:#CAC7C7; color:white">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center><h4 class="modal-title">Agregar Perfil</h4></center>
            </div>

            <div class="modal-body">
                <form role="form" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre y Apellidos" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar Email" id="nuevoEmail" required>
                        </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar contraseña" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                <select class="form-control input-lg" name="nuevoPerfil">
                                    <option value="">Selecionar perfil</option>
                                    <option value="administrador">Administrador</option>
                                    <option value="editor">Encargado</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="panel">SUBIR FOTO</div>
                            <input type="file" class="form-control nuevaFoto" name="nuevaFoto">
                            <p class="help-block">Peso máximo de la foto 2MB</p>
                            <img src="views/img/perfil/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
                        </div>
                    </div>
                </form>
            </div>
        
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                <button type="submit" class="btn btn-primary">Guardar Perfil</button>
            </div>

            <?php
            $crearPerfil = new ControladorAdministrador();
            $crearPerfil->ctrCrearPerfil();
            ?>
        </div>
    </div>
</div>

<!--=====================================
MODAL EDITAR PERFIL
======================================-->
<div id="modalEditarPerfil" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background:#CAC7C7; color:white">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center><h4 class="modal-title">Editar Perfil</h4><center>
            </div>

            <div class="modal-body">
                <form role="form" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>
                                <input type="hidden" id="idPerfil" name="idPerfil">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" class="form-control input-lg" id="editarEmail" name="editarEmail" value="" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Escriba la nueva contraseña">
                                <input type="hidden" id="passwordActual" name="passwordActual">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                <select class="form-control input-lg" name="editarPerfil">
                                    <option value="" id="editarPerfil"></option>
                                    <option value="administrador">Administrador</option>
                                    <option value="encargado">Encargado</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="panel">SUBIR FOTO</div>
                            <input type="file" class="nuevaFoto" name="editarFoto">
                            <p class="help-block">Peso máximo de la foto 2MB</p>
                            <img src="views/img/perfil/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
                            <input type="hidden" name="fotoActual" id="fotoActual">
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                <button type="submit" class="btn btn-primary">Modificar Perfil</button>
            </div>

            <?php
            $editarPerfil = new ControladorAdministrador();
            $editarPerfil->ctrEditarPerfil();
            ?>
        </div>
    </div>
</div>
<?php
$eliminarPerfil = new ControladorAdministrador();
$eliminarPerfil->ctrEliminarPerfil();
?>
