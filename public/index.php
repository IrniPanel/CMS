<?php
require "../vendor/autoload.php";

function show_with_script($page = "index"){
    $file_view_path = '../views/default/' . $page . '.php';
    if(file_exists($file_view_path)){
        echo readfile($file_view_path);
    }else{
        echo "<script type='text/javascript'> alert('Erreur 404 : Une erreur internne est apparu le fichier \"" . $file_view_path . "\" n\'a pas été trouver ! <br>'); </script>";
    }

    $file_src_path = '../src/IrniPanel/Pages/' . $page . '.php';
    if(file_exists($file_src_path)){
        require $file_src_path;
    }else{
        echo "<script type='text/javascript'> alert('Erreur 404 : Une erreur internne est apparu le fichier \"" . $file_src_path . "\" n\'a pas été trouver ! <br>'); </script>";
    }
}

$router = new App\IrniPanel\Router\Router($_GET['url']); 


$router->get('/', function(){ show_with_script(); }); 
$router->get('/card/:id', function($id){ echo "Voila l'article $id"; }); 
$router->get('/auth/login', function(){ show_with_script('/auth/login'); });
$router->post('/auth/login', function(){ show_with_script('/auth/login'); });
$router->get('/auth/register', function(){ show_with_script('/auth/register'); });
$router->post('/auth/register', function(){ show_with_script('/auth/register'); });
$router->get('/config.json', function(){});

$router->run(); 