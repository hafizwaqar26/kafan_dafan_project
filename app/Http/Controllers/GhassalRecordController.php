<?php

namespace App\Http\Controllers;

use App\Models\GhassalRecord;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GhassalRecordsExport;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GhassalRecordController extends Controller
{
    /**
     * Build filtered query based on request filters.
     */
    private function buildFilteredQuery(Request $request)
    {
        $query = GhassalRecord::query();

        // Mega search (q)
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('country', 'like', "%{$q}%")
                    ->orWhere('province', 'like', "%{$q}%")
                    ->orWhere('division', 'like', "%{$q}%")
                    ->orWhere('district', 'like', "%{$q}%")
                    ->orWhere('tehsil', 'like', "%{$q}%")
                    ->orWhere('sub_tehsil', 'like', "%{$q}%")
                    ->orWhere('uc', 'like', "%{$q}%")
                    ->orWhere('address', 'like', "%{$q}%")
                    ->orWhere('name', 'like', "%{$q}%")
                    ->orWhere('contact', 'like', "%{$q}%")
                    ->orWhere('time_of_ghusal', 'like', "%{$q}%");
            });
        }

        // Per-field filters
        if ($request->filled('country')) {
            $query->where('country', 'like', "%{$request->country}%");
        }
        if ($request->filled('province')) {
            $query->where('province', 'like', "%{$request->province}%");
        }
        if ($request->filled('division')) {
            $query->where('division', 'like', "%{$request->division}%");
        }
        if ($request->filled('district')) {
            $query->where('district', 'like', "%{$request->district}%");
        }
        if ($request->filled('tehsil')) {
            $query->where('tehsil', 'like', "%{$request->tehsil}%");
        }
        if ($request->filled('sub_tehsil')) {
            $query->where('sub_tehsil', 'like', "%{$request->sub_tehsil}%");
        }
        if ($request->filled('uc')) {
            $query->where('uc', 'like', "%{$request->uc}%");
        }
        if ($request->filled('address')) {
            $query->where('address', 'like', "%{$request->address}%");
        }
        if ($request->filled('name')) {
            $query->where('name', 'like', "%{$request->name}%");
        }
        if ($request->filled('contact')) {
            $query->where('contact', 'like', "%{$request->contact}%");
        }
        if ($request->filled('time_of_ghusal')) {
            $query->where('time_of_ghusal', 'like', "%{$request->time_of_ghusal}%");
        }

        // Latest first
        return $query->orderByDesc('id');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query   = $this->buildFilteredQuery($request);
        $records = $query->paginate(10)->withQueryString();

        return view('ghassal.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = DB::table('countries')->get();
        return view('ghassal.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'country'        => 'required',
            'province'       => 'required',
            'division'       => 'required',
            'district'       => 'required',
            'tehsil'         => 'required',
            'sub_tehsil'     => 'required',
            'uc'             => 'required',
            'address'        => 'required|string|max:255',
            'name'           => 'required|string|max:255',
            'contact'        => 'required|string|max:255|unique:ghassal_records,contact',
            'time_of_ghusal' => 'required|string|max:255',
        ]);

        // Save location IDs
        $data['country_id']    = $request->country;
        $data['province_id']   = $request->province;
        $data['division_id']   = $request->division;
        $data['district_id']   = $request->district;
        $data['tehsil_id']     = $request->tehsil;
        $data['sub_tehsil_id'] = $request->sub_tehsil;
        $data['uc_id']         = $request->uc;

        // If ID was sent in 'country', but we have 'country_name' hidden field, use that.
        $data['country']    = $request->country_name ?? $request->country;
        $data['province']   = $request->province_name ?? $request->province;
        $data['division']   = $request->division_name ?? $request->division;
        $data['district']   = $request->district_name ?? $request->district;
        $data['tehsil']     = $request->tehsil_name ?? $request->tehsil;
        $data['sub_tehsil'] = $request->sub_tehsil_name ?? $request->sub_tehsil;
        $data['uc']         = $request->uc_name ?? $request->uc;

        GhassalRecord::create($data);

        return redirect()->route('ghassal.index')
            ->with('success', 'Record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(GhassalRecord $ghassal)
    {
        return view('ghassal.show', compact('ghassal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GhassalRecord $ghassal)
    {
        $countries = DB::table('countries')->get();

        // Resolve current IDs for pre-selecting in dropdowns
        $ghassal->country_id    = DB::table('countries')->where('name', $ghassal->country)->value('id');
        $ghassal->province_id   = DB::table('provinces')->where('name', $ghassal->province)->value('id');
        $ghassal->division_id   = DB::table('divisions')->where('name', $ghassal->division)->value('id');
        $ghassal->district_id   = DB::table('districts')->where('name', $ghassal->district)->value('id');
        $ghassal->tehsil_id     = DB::table('tehsils')->where('name', $ghassal->tehsil)->value('id');
        $ghassal->sub_tehsil_id = DB::table('sub_tehsils')->where('name', $ghassal->sub_tehsil)->value('id');
        $ghassal->uc_id         = DB::table('union_councils')->where('name', $ghassal->uc)->value('id');

        return view('ghassal.edit', compact('ghassal', 'countries'));
    }

    /**
     */
    public function update(Request $request, GhassalRecord $ghassal)
    {
        $data = $request->validate([
            'country'        => 'required',
            'province'       => 'required',
            'division'       => 'required',
            'district'       => 'required',
            'tehsil'         => 'required',
            'sub_tehsil'     => 'required',
            'uc'             => 'required',
            'address'        => 'required|string|max:255',
            'name'           => 'required|string|max:255',
            'contact'        => [
                'required',
                'string',
                'max:255',
                Rule::unique('ghassal_records', 'contact')->ignore($ghassal->id),
            ],
            'time_of_ghusal' => 'required|string|max:255',
        ]);
        $data['country_id']    = $request->country;
        $data['province_id']   = $request->province;
        $data['division_id']   = $request->division;
        $data['district_id']   = $request->district;
        $data['tehsil_id']     = $request->tehsil;
        $data['sub_tehsil_id'] = $request->sub_tehsil;
        $data['uc_id']         = $request->uc;

        $data['country']    = $request->country_name ?? $request->country;
        $data['province']   = $request->province_name ?? $request->province;
        $data['division']   = $request->division_name ?? $request->division;
        $data['district']   = $request->district_name ?? $request->district;
        $data['tehsil']     = $request->tehsil_name ?? $request->tehsil;
        $data['sub_tehsil'] = $request->sub_tehsil_name ?? $request->sub_tehsil;
        $data['uc']         = $request->uc_name ?? $request->uc;

        $ghassal->update($data);

        return redirect()->route('ghassal.index')
            ->with('success', 'Record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GhassalRecord $ghassal)
    {
        $ghassal->delete();

        return redirect()->route('ghassal.index')
            ->with('success', 'Record deleted successfully.');
    }

    /**
     * Export filtered data to Excel.
     */
    public function exportExcel(Request $request)
    {
        $query   = $this->buildFilteredQuery($request);
        $records = $query->get();

        $fileName = 'ghassal_records_' . now()->format('Y_m_d_H_i_s') . '.xlsx';

        return Excel::download(new GhassalRecordsExport($records), $fileName);
    }

    /**
     * Export filtered data to PDF (Browsershot, Urdu/RTL safe).
     */
    public function ghassalExportPdf(Request $request)
    {
        // Same filters as index, but all rows (no pagination)
        $query   = $this->buildFilteredQuery($request);
        $records = $query->get();

        $html = view('ghassal.exports.pdf', compact('records'))->render();

        $path = storage_path('app/ghassal_records.pdf');

        Browsershot::html($html)
            ->format('A4')
            ->landscape()
            ->margins(10, 10, 10, 10)
            ->save($path);

        return response()->download($path, 'ghassal_records_' . now()->format('Y_m_d_H_i_s') . '.pdf')
            ->deleteFileAfterSend(true);
    }

    public function getProvinces($countryId)
    {
        return response()->json(DB::table('provinces')->where('parent_id', $countryId)->get());
    }

    public function getDivisions($provinceId)
    {
        return response()->json(DB::table('divisions')->where('parent_id', $provinceId)->get());
    }

    public function getDistricts($divisionId)
    {
        return response()->json(DB::table('districts')->where('parent_id', $divisionId)->get());
    }

    public function getTehsils($districtId)
    {
        return response()->json(DB::table('tehsils')->where('parent_id', $districtId)->get());
    }

    public function getSubTehsils($tehsilId)
    {
        return response()->json(DB::table('sub_tehsils')->where('parent_id', $tehsilId)->get());
    }

    public function getUcs($subTehsilId)
    {
        return response()->json(DB::table('union_councils')->where('parent_id', $subTehsilId)->get());
    }
}