<?php

namespace App\Repositories;

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

        $people->contacts()->createMany($contacts);
    }
}
