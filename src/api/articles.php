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
            0 => [
                'title' => 'El cohete de Space X',
                'subTitle' => 'La Compañia Space X tiene nuevo cohete',
                'create' => '15m',
                'image' => 'world.png',
                'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book"
            ],
            1 => [
                'title' => 'El cohete de Space X',
                'subTitle' => 'La Compañia Space X tiene nuevo cohete',
                'create' => '15m',
                'image' => 'world.png',
                'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book"
            ],
            2 => [
                'title' => 'El cohete de Space X',
                'subTitle' => 'La Compañia Space X tiene nuevo cohete',
                'create' => '15m',
                'image' => 'world.png',
                'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book"
            ],
        ],
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
            0 => [
                'title' => 'El cohete de Space X',
                'subTitle' => 'La Compañia Space X tiene nuevo cohete',
                'create' => '15m',
                'image' => 'world.png',
                'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book"
            ],
            1 => [
                'title' => 'El cohete de Space X',
                'subTitle' => 'La Compañia Space X tiene nuevo cohete',
                'create' => '15m',
                'image' => 'world.png',
                'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book"
            ],
        ],
    ];

    // devolver siempre el objeto $response
    return $response->withJson($data, $statusCode);
});

?>