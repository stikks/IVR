<?php

/**
 * Created by PhpStorm.
 * User: stikks
 * Date: 9/28/16
 * Time: 8:13 AM
 */
namespace App\Controllers;

class LoginController extends BaseController
{

    public function getPage($request, $response) {
        return $this->view->render($response, 'templates/login.twig');
    }

    public function postData($request, $response) {

        $auth = $this->container->auth->attempt(
            $request->getParam('username'),
            $request->getParam('password')
        );

        if(!$auth) {
            return $this->view->render($response, 'templates/login.twig', [
                'error' => 'Invalid username/password combination'
            ]);
        }

        return $response->withRedirect($this->router->pathFor('index'));
    }
}