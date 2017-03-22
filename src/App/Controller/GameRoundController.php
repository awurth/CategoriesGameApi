<?php

namespace App\Controller;

use App\Model\Game;
use App\Model\Round;
use App\Model\RoundSubjectUser;
use App\Model\Subject;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class GameRoundController extends Controller
{
    public function getGameRounds(Request $request, Response $response, $id)
    {
        $userId = $request->getParam('user_id');
        $roundId = $request->getParam('round_id');
        $subjectId = $request->getParam('subject_id');

        if ($userId || $roundId || $subjectId) {
            $game = Game::with(['rounds' => function ($query) use ($roundId) {
                if ($roundId) {
                    $query->where('id', $roundId);
                }
            }, 'rounds.values' => function ($query) use ($userId, $subjectId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                }

                if ($subjectId) {
                    $query->where('subject_id', $subjectId);
                }
            }])->find($id);
        } else {
            $game = Game::with('rounds')->find($id);
        }

        if (null === $game) {
            throw $this->notFoundException($request, $response);
        }

        return $this->ok($response, $game->rounds);
    }

    public function getGameRound(Request $request, Response $response, $gameId, $roundId)
    {
        $game = Game::find($gameId);

        if (null === $game) {
            throw $this->notFoundException($request, $response);
        }

        $round = Round::find($roundId);

        if (null === $round) {
            throw $this->notFoundException($request, $response);
        }

        return $this->ok($response, $round);
    }

    public function postGameRound(Request $request, Response $response, $id)
    {
        $game = Game::with('rounds')->find($id);

        if (null === $game) {
            throw $this->notFoundException($request, $response);
        }

        $lastRound = $game->rounds->last();

        if ($lastRound && !$lastRound->finished) {
            $this->validator->addError('round', 'Last round is not finished');
            return $this->validationErrors($response);
        }

        $usedLetters = [];
        foreach ($game->rounds as $round) {
            $usedLetters[] = $round->letter;
        }

        $letter = $this->getRandomLetter($usedLetters);

        if (!$letter) {
            $this->validator->addError('letter', 'All letters are already used');
        }

        if ($this->validator->isValid()) {
            $round = new Round(['letter' => $letter]);
            $round->game()->associate($game);

            $round->save();

            foreach ($game->subjects as $subject) {
                $roundSubjectUser = new RoundSubjectUser(['value' => '']);
                $roundSubjectUser->round()->associate($round);
                $roundSubjectUser->subject()->associate($subject);
                $roundSubjectUser->user()->associate($game->owner);
                $roundSubjectUser->save();

                foreach ($game->players as $player) {
                    $roundSubjectUser = new RoundSubjectUser(['value' => '']);
                    $roundSubjectUser->round()->associate($round);
                    $roundSubjectUser->subject()->associate($subject);
                    $roundSubjectUser->user()->associate($player);
                    $roundSubjectUser->save();
                }
            }

            return $this->created($response, 'get_game_round', [
                'game_id' => $id,
                'round_id' => $round->id
            ]);
        }

        return $this->validationErrors($response);
    }

    public function patchGameRound(Request $request, Response $response, $gameId, $roundId) {
        $game = Game::find($gameId);

        if (null === $game) {
            throw $this->notFoundException($request, $response);
        }

        $round = Round::find($roundId);

        if (null === $round) {
            throw $this->notFoundException($request, $response);
        }

        $subject = Subject::find($request->getParam('subject_id'));

        if (null === $subject) {
            throw $this->notFoundException($request, $response);
        }

        $user = $this->getUser();

        $roundSubjectUser = RoundSubjectUser::where('round_id', $roundId)
            ->where('subject_id', $subject->id)
            ->where('user_id', $user->id)->first();

        if (null === $roundSubjectUser) {
            throw $this->notFoundException($request, $response);
        }

        $roundSubjectUser->value = $request->getParam('value');
        $roundSubjectUser->save();

        return $this->noContent($response);
    }

    private function getRandomLetter(array $usedLetters = [])
    {
        $alphabet = array_diff(str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), $usedLetters);

        return $alphabet[rand(0, count($alphabet) - 1)];
    }
}
