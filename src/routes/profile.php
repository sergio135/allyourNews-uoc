<?php
//////////////////////////////////////////////////
// Configuracion de la ruta del perfil de usuario //
//////////////////////////////////////////////////
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// metodo que maneja cada una de las llamadas a la ruta '/profile'
$app->get('/profile', function (Request $request, Response $response, array $args) {
    // $request: objeto que trae informacion sobre la peticion a la ruta.
    // $response: objeto con metodos que sirve para responder al cliente.
    // $args: deferentes argumentos pasados en la peticion.


    // renderizamos la plantilla profile.phtml 
    $response = $this->view->render($response, 'profile.phtml', []);

    // devolver siempre el objeto $response
    return $response;
});
?>