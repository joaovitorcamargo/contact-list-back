<?php

namespace App\Services;

use App\Repositories\{
    ContactRepository,
    PeopleRepository
};
use Exception;

class PeopleService
{
    private $peopleRepository;
    private $contactRepository;

    public function __construct(PeopleRepository $peopleRepository, ContactRepository $contactRepository)
    {
        $this->peopleRepository = $peopleRepository;
        $this->contactRepository = $contactRepository;
    }

    public function getAllPeoples($params)
    {
        return $this->peopleRepository->getAllPeoples($params);
    }

    public function createPeople($data)
    {
        $people = $this->peopleRepository->createPeople($data);
        $contactCreated = $this->contactRepository->createContactsForPeople($people, $data['contacts']);

        if (!$contactCreated) {
            throw new Exception('Contact Already Exists', 409);
        }
    }

    public function updatePeople($peopleId, $data)
    {
        $peopleUpdated = $this->peopleRepository->editPeople($peopleId, $data);

        if (!$peopleUpdated) {
            throw new Exception('People Not Found', 404);
        }
    }

    public function deletePeople($peopleId)
    {
        $peopleDeleted = $this->peopleRepository->deletePeople($peopleId);

        if (!$peopleDeleted) {
            throw new Exception('People Not Found', 404);
        }
    }
}
