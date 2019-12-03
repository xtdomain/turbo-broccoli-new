<?php
session_start();
define("ROOT", $_SERVER['DOCUMENT_ROOT']);
define("CONTROLLERS", ROOT. "/controllers/");
define("VIEWS", ROOT. "/views/");
define("MODELS", ROOT. "/models/");
require_once ("route.php");
require_once ("db.php");
require_once CONTROLLERS. 'Controller.php';
require_once VIEWS. 'View.php';
require_once MODELS. 'Model.php';

 ?>
