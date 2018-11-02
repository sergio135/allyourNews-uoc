<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/profile', function (Request $request, Response $response, array $args) {

    $response = $this->view->render($response, 'profile.phtml', []);
    return $response;
});
?>