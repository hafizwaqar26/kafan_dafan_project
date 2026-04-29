<?php

namespace App\Http\Controllers;

use App\Models\GhassalRecord;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GhassalRecordsExport;
use Spatie\Browsershot\Browsershot;

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
        return view('ghassal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'country'        => 'required|string|max:255',
            'province'       => 'required|string|max:255',
            'division'       => 'required|string|max:255',
            'district'       => 'required|string|max:255',
            'tehsil'         => 'required|string|max:255',
            'sub_tehsil'     => 'required|string|max:255',
            'uc'             => 'required|string|max:255',
            'address'        => 'required|string|max:255',
            'name'           => 'required|string|max:255',
            'contact'        => 'required|string|max:255|unique:ghassal_records,contact',
            'time_of_ghusal' => 'required|string|max:20',
        ]);

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
        return view('ghassal.edit', compact('ghassal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GhassalRecord $ghassal)
    {
        $data = $request->validate([
            'country'        => 'required|string|max:255',
            'province'       => 'required|string|max:255',
            'division'       => 'required|string|max:255',
            'district'       => 'required|string|max:255',
            'tehsil'         => 'required|string|max:255',
            'sub_tehsil'     => 'required|string|max:255',
            'uc'             => 'required|string|max:255',
            'address'        => 'required|string|max:255',
            'name'           => 'required|string|max:255',
            'contact'        => [
                'required',
                'string',
                'max:255',
                Rule::unique('ghassal_records', 'contact')->ignore($ghassal->id),
            ],
            'time_of_ghusal' => 'required|string|max:20',
        ]);

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

        $html = view('ghassal.pdf', compact('records'))->render();

        $path = storage_path('app/ghassal_records.pdf');

        Browsershot::html($html)
            ->format('A4')
            ->landscape()
            ->margins(10, 10, 10, 10)
            ->save($path);

        return response()->download($path, 'ghassal_records_' . now()->format('Y_m_d_H_i_s') . '.pdf')
            ->deleteFileAfterSend(true);
    }
}