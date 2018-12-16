<?php
/////////////////////////////////////////////////////////
// Configuracion de la ruta del panel de administracion //
/////////////////////////////////////////////////////////
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// metodo que maneja cada una de las llamadas a la ruta '/administration'
$app->get('/administration', function (Request $request, Response $response, array $args) {
    // $request: objeto que trae informacion sobre la peticion a la ruta.
    // $response: objeto con metodos que sirve para responder al cliente.
    // $args: deferentes argumentos pasados en la peticion.
    if (!isset($_SESSION['user'])) {
        return $res->withRedirect('/auth');
    }

    $news = new NewsController($this);
    $result = $news->getNewsUrls($_SESSION['user']);

    // renderizamos la plantilla administration.phtml 
    $response = $this->view->render($response, 'administration.phtml', [
        'isLoged' => true,
        'rssList' => $result
    ]);

    // devolver siempre el objeto $response
    return $response;
});
?>