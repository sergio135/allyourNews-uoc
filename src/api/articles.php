<?php
/////////////////////////////////////////////////
// Configuracion de la ruta REST inicio session //
/////////////////////////////////////////////////
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// metodo que maneja cada una de las llamadas a la ruta '/api/login'
$app->get('/api/articles', function (Request $req, Response $res, array $args) {
    // $request: objeto que trae informacion sobre la peticion a la ruta.
    // $response: objeto con metodos que sirve para responder al cliente.
    // $args: deferentes argumentos pasados en la peticion.
    $news = new NewsController($this);
    $result = $news->getNewsUrls($_SESSION['user']);
    
    if (array_key_exists("error", $result)) {
        return $res->withJson($result, 500);  
    }
    
    return $res->withJson($result, 200);
});

$app->get('/api/articles/{tag}', function (Request $req, Response $res, array $args) {
    // $request: objeto que trae informacion sobre la peticion a la ruta.
    // $response: objeto con metodos que sirve para responder al cliente.
    // $args: deferentes argumentos pasados en la peticion.
    $tag = $args['tag'];

    $news = new NewsController($this);
    $result = $news->getNewsUrls($_SESSION['user']);
    
    if (array_key_exists("error", $result)) {
        return $res->withJson($result, 500);  
    }
    
    return $res->withJson($result, 200);
});

?>