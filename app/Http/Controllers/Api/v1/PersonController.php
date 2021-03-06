<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\PersonRequest;
use App\Http\Resources\Api\v1\PersonCollection;
use App\Http\Resources\Api\v1\PersonResource;
use App\Models\Person;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PersonController extends Controller
{
    public function index()
    {
        $people = Person::paginate(10);
        return response(new PersonCollection($people), Response::HTTP_OK);
    }

    public function store(PersonRequest $request)
    {
        $person = $this->save($request);

        return response(new PersonResource($person), Response::HTTP_CREATED);
    }

    public function show(Request $request)
    {
        $person = $request->person;

        return response(new PersonResource($person), Response::HTTP_OK);
    }

    public function update(PersonRequest $request)
    {
        $person = $this->save($request);

        return response(new PersonResource($person), Response::HTTP_OK);
    }

    public function destroy(Request $request)
    {
        $person = $request->person;
        $person->delete();

        return response('', Response::HTTP_OK);
    }

    private function save(Request $request)
    {
        $person = Person::firstOrNew(['id' => $request->movieId ?? null]);
        $person->last_name = $request->last_name ?? $person->last_name;
        $person->first_name = $request->first_name ?? $person->first_name;
        $person->middle_name = $request->middle_name ?? $person->middle_name;
        $person->alias = $request->alias ?? $person->alias;
        $person->gender = $request->gender ?? $person->gender;
        $person->birth_date = $request->birth_date ?? $person->birth_date;
        $person->save();

        return $person;
    }
}
