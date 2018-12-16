<?php
/////////////////////////////////////////////////
// Configuracion de la ruta REST inicio session //
/////////////////////////////////////////////////
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// metodo que maneja cada una de las llamadas a la ruta '/api/login'
$app->get('/add-url', function (Request $req, Response $res, array $args) {
    // $request: objeto que trae informacion sobre la peticion a la ruta.
    // $response: objeto con metodos que sirve para responder al cliente.
    // $args: deferentes argumentos pasados en la peticion.
    $newUrl = $req->getParam('rss');

    $news = new NewsController($this);
    $result = $news->addNewUrls($_SESSION['user'], $newUrl);
    
    return $res->withRedirect('/administration', 301);
});



?>