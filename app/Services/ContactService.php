<?php

namespace App\Services;

use App\Repositories\{
    ContactRepository
};
use Exception;

class ContactService
{
    private $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function deleteContact($contactId)
    {
        $contactDeleted = $this->contactRepository->deleteContact($contactId);

        if (!$contactDeleted) {
            throw new Exception('Contact Not Found', 404);
        }
    }

    public function updateContact($contactId, $data)
    {
        $contactUpdated = $this->contactRepository->editContact($contactId, $data);

        if (!$contactUpdated) {
            throw new Exception('Contact Not Found', 404);
        }
    }
}
