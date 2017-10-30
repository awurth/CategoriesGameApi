<?php

namespace App\Game\Controller;

use App\Core\Controller\Controller;
use Respect\Validation\Validator as V;
use App\Game\Model\Subject;
use Slim\Http\Request;
use Slim\Http\Response;

class SubjectController extends Controller
{
    public function getSubjects(Request $request, Response $response)
    {
        return $this->ok($response, Subject::all());
    }

    public function getSubject(Request $request, Response $response, $id)
    {
        $subject = Subject::find($id);

        if (null === $subject) {
            throw $this->notFoundException($request, $response);
        }

        return $this->ok($response, $subject);
    }

    public function postSubject(Request $request, Response $response)
    {
        $this->validator->validate($request, [
            'name' => V::notBlank()
        ]);

        if ($this->validator->isValid()) {
            $subject = new Subject($this->params($request, ['name']));
            $subject->save();

            return $this->created($response, 'get_subject', [
                'id' => $subject->id
            ]);
        }

        return $this->validationErrors($response);
    }

    public function putSubject(Request $request, Response $response, $id)
    {
        $subject = Subject::find($id);

        if (null === $subject) {
            throw $this->notFoundException($request, $response);
        }

        $this->validator->validate($request, [
            'name' => V::notBlank()
        ]);

        if ($this->validator->isValid()) {
            $subject->name = $request->getParam('name');
            $subject->save();

            return $this->noContent($response);
        }

        return $this->validationErrors($response);
    }

    public function deleteSubject(Request $request, Response $response, $id)
    {
        $subject = Subject::find($id);

        if (null === $subject) {
            throw $this->notFoundException($request, $response);
        }

        $subject->games()->detach();
        $subject->delete();

        return $this->noContent($response);
    }
}
