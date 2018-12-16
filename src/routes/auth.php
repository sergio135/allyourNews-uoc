<?php
////////////////////////////////////////////////
// Configuracion de la ruta del registro/login //
////////////////////////////////////////////////
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// metodo que maneja cada una de las llamadas a la ruta '/auth'
$app->get('/auth', function (Request $request, Response $response, array $args) {
    // $request: objeto que trae informacion sobre la peticion a la ruta.
    // $response: objeto con metodos que sirve para responder al cliente.
    // $args: deferentes argumentos pasados en la peticion.

    // renderizamos la plantilla register.phtml 
    $response = $this->view->render($response, 'auth.phtml', [
        'isLogin' => false
    ]);

    // devolver siempre el objeto $response
    return $response;
});
?>