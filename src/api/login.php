<?php
/////////////////////////////////////////////////
// Configuracion de la ruta REST inicio session //
/////////////////////////////////////////////////
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// metodo que maneja cada una de las llamadas a la ruta '/api/login'
$app->post('/api/login', function (Request $req, Response $res, array $args) {
    // $request: objeto que trae informacion sobre la peticion a la ruta.
    // $response: objeto con metodos que sirve para responder al cliente.
    // $args: deferentes argumentos pasados en la peticion.

    // los datos que vienen del formulario
    $dataForm = json_decode($req->getBody(), true);
   
    $adminPanel = new UserController($this);
    $result = $adminPanel->login($dataForm);
    
    if (array_key_exists("error", $result)) {
        return $res->withJson($result, 500);  
    }
    $_SESSION['user'] = $result;
    return $res->withJson($result, 200); 
});

?>