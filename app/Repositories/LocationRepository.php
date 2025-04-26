<?php

namespace App\Repositories;

use App\Models\Location;

class LocationRepository
{
    public function getAll()
    {
        return Location::all();
    }
}
