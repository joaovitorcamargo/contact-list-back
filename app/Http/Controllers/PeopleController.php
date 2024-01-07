<?php

namespace App\Http\Controllers;

use App\Http\Requests\{
    PeopleContactRequest,
    PeopleEditRequest
};
use App\Models\People;
use App\Services\PeopleService;
use Exception;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    private $peopleService;

    public function __construct(PeopleService $peopleService)
    {
        $this->peopleService = $peopleService;
    }

    public function getAllPeoples(Request $request)
    {
        try {
            $peoples = $this->peopleService->getAllPeoples($request->all());
            return response()->json([
                'peoples' => $peoples
            ], 200);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function registerPeople(PeopleContactRequest $request)
    {
        try {
            $validatedRequest = $request->validated();
            $this->peopleService->createPeople($validatedRequest);
            return response()->json([], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function getPeople(People $people)
    {
        try {
            $people = $this->peopleService->getPeople($people->id);
            return response()->json([
                'people' => $people
            ], 200);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function editPeople(People $people, PeopleContactRequest $request)
    {
        try {
            $validatedRequest = $request->validated();
            $this->peopleService->updatePeople($people->id, $validatedRequest);
            return response()->json([], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function deletePeople(People $people)
    {
        try {
            $this->peopleService->deletePeople($people->id);
            return response()->json([], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }
}
