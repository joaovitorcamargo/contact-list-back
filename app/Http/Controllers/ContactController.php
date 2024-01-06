<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactEditRequest;
use App\Models\Contact;
use App\Services\ContactService;
use Exception;

class ContactController extends Controller
{
    private $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function deleteContact(Contact $contact)
    {
        try {
            $this->contactService->deleteContact($contact->id);
            return response()->json([], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function editContact(Contact $contact, ContactEditRequest $request)
    {
        try {
            $validatedRequest = $request->validated();
            $this->contactService->updateContact($contact->id, $validatedRequest);
            return response()->json([], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }
}
