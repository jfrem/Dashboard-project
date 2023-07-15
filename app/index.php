<?php 
require_once 'config/config.php';



// require_once 'library/Db.php';
// require_once 'library/Controller.php';
// require_once 'library/Core.php';

spl_autoload_register(function($nameClass){
    require_once 'library/'.$nameClass.'.php';
});