<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GhassalRecordsExport implements FromCollection, WithHeadings
{
    protected Collection $records;

    public function __construct(Collection $records)
    {
        $this->records = $records;
    }

    public function collection()
    {
        // Map models to simple arrays for Excel
        return $this->records->map(function ($record) {
            return [
                'id'             => $record->id,
                'country'        => $record->country,
                'province'       => $record->province,
                'division'       => $record->division,
                'district'       => $record->district,
                'tehsil'         => $record->tehsil,
                'sub_tehsil'     => $record->sub_tehsil,
                'uc'             => $record->uc,
                'address'        => $record->address,
                'name'           => $record->name,
                'contact'        => $record->contact,
                'time_of_ghusal' => $record->time_of_ghusal,
                'created_at'     => $record->created_at,
                'updated_at'     => $record->updated_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Country',
            'Province',
            'Division',
            'District',
            'Tehsil',
            'Sub Tehsil',
            'UC',
            'Address',
            'Name',
            'Contact',
            'Time of Ghusal',
            'Created At',
            'Updated At',
        ];
    }
}