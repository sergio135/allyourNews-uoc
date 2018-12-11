<?php
/////////////////////////////////////////////////
// Configuracion de la ruta REST inicio session //
/////////////////////////////////////////////////
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// metodo que maneja cada una de las llamadas a la ruta '/api/login'
$app->get('/api/articles', function (Request $request, Response $response, array $args) {
    // $request: objeto que trae informacion sobre la peticion a la ruta.
    // $response: objeto con metodos que sirve para responder al cliente.
    // $args: deferentes argumentos pasados en la peticion.

    $statusCode = 200;
    $data = [
        'errors' => [
            'messagge' => 'El usuario no existe'
        ],
        'articles' => [
            'https://www.20minutos.es/rss/',
        ]
    ];

    // devolver siempre el objeto $response
    return $response->withJson($data, $statusCode);
});

$app->get('/api/articles/{tag}', function (Request $request, Response $response, array $args) {
    // $request: objeto que trae informacion sobre la peticion a la ruta.
    // $response: objeto con metodos que sirve para responder al cliente.
    // $args: deferentes argumentos pasados en la peticion.

    $tag = $args['tag'];
    $statusCode = 200;
    $data = [
        'tag' => $tag,
        'errors' => [
            'messagge' => 'El usuario no existe'
        ],
        'articles' => [
            'https://www.20minutos.es/rss/',
        ]
    ];

    // devolver siempre el objeto $response
    return $response->withJson($data, $statusCode);
});

?>