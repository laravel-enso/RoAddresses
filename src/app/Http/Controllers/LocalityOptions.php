<?php

namespace LaravelEnso\RoAddresses\App\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\RoAddresses\App\Models\Locality;
use LaravelEnso\Select\App\Traits\OptionsBuilder;

class LocalityOptions extends Controller
{
    use OptionsBuilder;

    protected $queryAttributes = ['name', 'siruta', 'township'];

    public function query()
    {
        return Locality::active();
    }
}
