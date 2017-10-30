<?php

namespace App\Core\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

class CoreController extends Controller
{
    public function root(Request $request, Response $response)
    {
        return $this->ok($response, [
            'game' => [
                'subjects' => $this->path('get_subjects'),
                'game' => $this->path('get_games')
            ],
            'security' => [
                'login' => $this->path('login'),
                'register' => $this->path('register'),
                'refresh_token' => $this->path('jwt.refresh'),
                'user' => $this->path('users.me')
            ]
        ]);
    }
}
