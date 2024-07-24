<?php 

require_once "controllers/template.controller.php";
require_once "controllers/administrador.controller.php";
require_once "models/administrador.model.php";
require_once "models/rutas.php";

$template = new template_controller();
$template->ctrTemplate();
