<?php

namespace App\Repositories;

use App\Models\People;

class PeopleRepository
{
    public function getAllPeoples($params)
    {
        $peoples = People::with('contacts');

        foreach ($params as $key => $value) {
            if ($key == 'name') {
                $peoples->where($key, 'like', '%' . $value . '%');
            }
            if ($key === 'contact_info' || $key === 'type') {
                $peoples->whereHas('contacts', function ($query) use ($key, $value) {
                    $query->where($key, 'like', '%' . $value . '%');
                });
            }
        }

        $peoples = $peoples->get();

        return $peoples;
    }

    public function createPeople($data)
    {
        return People::create($data);
    }

    public function editPeople($peopleId, $data)
    {
        $people = People::find($peopleId);
        $people->update($data);
        if (!$people) {
            return false;
        }

        return true;
    }

    public function deletePeople($peopleId)
    {
        $people = People::find($peopleId);
        if (!$people) {
            return false;
        }

        $people->contacts()->delete();
        $people->delete();

        return true;
    }
}
