<?php

namespace App\Repositories;

use App\Models\People;

class PeopleRepository
{
    public function getAllPeoples()
    {
        return People::with('contacts')->get();
    }

    public function createPeople($data)
    {
        return People::create($data);
    }
}
