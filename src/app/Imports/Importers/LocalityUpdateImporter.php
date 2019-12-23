<?php

namespace LaravelEnso\RoAddresses\app\Imports\Importers;

use LaravelEnso\DataImport\app\Contracts\Importable;
use LaravelEnso\Helpers\app\Classes\Obj;
use LaravelEnso\RoAddresses\app\Models\County;
use LaravelEnso\RoAddresses\app\Models\Locality;

class LocalityUpdateImporter implements Importable
{
    public function run(Obj $row, Obj $params)
    {
        $this->importLocalities($row);
    }

    private function importLocalities($row)
    {
        $this->locality($row)->update([
            'siruta' => $row->siruta,
            'lat' => $row->lat,
            'long' => $row->long,
            'is_active' => $row->is_active,
        ]);
    }

    private function locality($row)
    {
        return Locality::whereName($row->locality)
            ->where('county_id', $this->countyId($row->county))
            ->when($row->township !== null, fn($query) => (
                $query->whereTownship($row->township)
            ))->first();
    }

    private function countyId($county)
    {
        return County::whereName($county)
            ->first()
            ->id;
    }
}
