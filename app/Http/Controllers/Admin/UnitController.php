<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UnitRequest;
use App\Models\Admin\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UnitController extends Controller
{
    /**
     * Constructor to share active units count with all views
     */
    

    /**
     * Display a listing of the units.
     */
    public function index()
    {
        $units = Unit::latest()->paginate(10);
        return view('admin.units.index', compact('units'));
    }

    /**
     * Show the form for creating a new unit.
     */
    public function create()
    {
        return view('admin.units.create');
    }

    /**
     * Store a newly created unit in storage.
     */
    public function store(UnitRequest $request)
    {
        Unit::create($request->validated());

        return redirect()->route('admin.units.index')
            ->with('message', 'Unit created successfully.')
            ->with('alert-type', 'success');
    }

    /**
     * Show the form for editing the specified unit.
     */
    public function edit(Unit $unit)
    {
        return view('admin.units.edit', compact('unit'));
    }

    /**
     * Update the specified unit in storage.
     */
    public function update(UnitRequest $request, Unit $unit)
    {
        $unit->update($request->validated());

        return redirect()->route('admin.units.index')
        ->with('message', 'Unit updated successfully.')
        ->with('alert-type', 'success');    
    }

    /**
     * Remove the specified unit from storage.
     */
    public function destroy(Unit $unit)
    {
        // Check if unit is being used in any enquiry items
        if ($unit->enquiryItems()->exists()) {
            return redirect()->route('admin.units.index')
            ->with('message', 'Unit cannot be deleted as it is being used in enquiry items.')
            ->with('alert-type', 'error');
        }

        $unit->delete();

        return redirect()->route('admin.units.index')
            ->with('message', 'Unit deleted successfully.')
            ->with('alert-type', 'success');
    }

    /**
     * Toggle the status of the specified unit.
     */
    public function toggleStatus(Unit $unit)
    {
        $unit->update(['status' => !$unit->status]);

        return redirect()->route('admin.units.index')
            ->with('message', 'Unit status updated successfully.')
            ->with('alert-type', 'success');
    }
}