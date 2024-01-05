<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeopleRequest;
use App\Repositories\ContactRepository;
use App\Repositories\PeopleRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\throwException;

class PeopleController extends Controller
{
    private $peopleRepository;
    private $contactRepository;

    public function __construct(PeopleRepository $peopleRepository, ContactRepository $contactRepository)
    {
        $this->peopleRepository = $peopleRepository;
        $this->contactRepository = $contactRepository;
    }

    public function getAllPeoples()
    {
        try {
            $people = $this->peopleRepository->getAllPeoples();

            return response()->json([
                'data' => $people
            ], 200);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function registerPeople(PeopleRequest $request)
    {
        try {
            $validatedRequest = $request->validated();
            $people = $this->peopleRepository->createPeople($validatedRequest);
            $this->contactRepository->createContactsForPeople($people, $validatedRequest['contacts']);
            return response()->json([], 201);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function editPeople()
    {
        Log::info('aqui edit');
    }

    public function deletePeople()
    {
        Log::info('aqui delete');
    }
}
