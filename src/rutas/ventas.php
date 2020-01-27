<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../../vendor/autoload.php';
require '../../src/config/Db.php';

$app = new \Slim\App;
//rutasss
$app->get('/api/prueba', function (Request $request, Response $response) {
    $pdo= new DB();
    $consulta = $pdo->prepare('SELECT * FROM bancos_tipos_cuentas');
    $consulta->execute();
    $registro = $consulta->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($registro);
    $consulta=null;
    $registro=null;
    $pdo=null;
});
$app->run();