<?php

namespace App\Repositories;

use App\Models\Contact;

class ContactRepository
{
    public function createContactsForPeople($people, $data)
    {
        $contacts = collect($data)->map(function ($contactData) {
            return [
                'type' => $contactData['type'],
                'contact_info' => $contactData['contact_info'],
            ];
        })->all();

        foreach ($contacts as $value) {
            $alreadyExistsContact = Contact::where('type', $value['type'])
                ->where('contact_info', $value['contact_info'])
                ->first();

            if ($alreadyExistsContact) {
                return false;
            }
        }

        $people->contacts()->createMany($contacts);

        return true;
    }

    public function deleteContact($contactId)
    {
        $contact = Contact::find($contactId);
        if (!$contact) {
            return false;
        }
        $contact->delete();

        return true;
    }

    public function editContact($contactId, $data)
    {
        $contact = Contact::find($contactId);
        $contact->update($data);
        if (!$contact) {
            return false;
        }

        return true;
    }
}
