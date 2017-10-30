<?php

namespace App\Game\Controller;

use App\Core\Controller\Controller;
use Respect\Validation\Validator as V;
use App\Game\Model\Round;
use Slim\Http\Request;
use Slim\Http\Response;

class RoundController extends Controller
{
    public function getRounds(Request $request, Response $response)
    {
        return $this->ok($response, Round::all());
    }

    public function getRound(Request $request, Response $response, $id)
    {
        $round = Round::find($id);

        if (null === $round) {
            throw $this->notFoundException($request, $response);
        }

        return $this->ok($response, $round);
    }

    public function postRound(Request $request, Response $response)
    {
        $this->validator->validate($request, [
            'letter' => V::notBlank()->alpha()
        ]);

        if ($this->validator->isValid()) {
            $round = new Round($this->params($request, ['letter']));
            $round->save();

            return $this->created($response, 'get_round', [
                'id' => $round->id
            ]);
        }

        return $this->validationErrors($response);
    }

    public function putRound(Request $request, Response $response, $id)
    {
        $round = Round::find($id);

        if (null === $round) {
            throw $this->notFoundException($request, $response);
        }

        $this->validator->validate($request, [
            'letter' => V::notBlank()->alpha()
        ]);

        if ($this->validator->isValid()) {
            $round->name = $request->getParam('letter');
            $round->save();

            return $this->noContent($response);
        }

        return $this->validationErrors($response);
    }

    public function deleteRound(Request $request, Response $response, $id)
    {
        $round = Round::find($id);

        if (null === $round) {
            throw $this->notFoundException($request, $response);
        }

        $round->delete();

        return $this->noContent($response);
    }
}
