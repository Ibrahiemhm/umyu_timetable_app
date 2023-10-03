<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Venue;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreVenueRequest;
use App\Http\Requests\UpdateVenueRequest;

class VenuesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Venue::all();
            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $crudRoutePart = 'venues';

                return view('partials.datatablesActions', compact(
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : "";
            });
            $table->editColumn('capacity', function ($row) {
                return $row->capacity ? $row->capacity : "";
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? ($row->status == 1 ? "Enabled" : "Disabled") : "Disabled";
            });

            $table->rawColumns(['actions']);

            return $table->make(true);
            
        }

        return view('admin.venues.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.venues.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVenueRequest $request)
    {
        $venue = Venue::create($request->all());
        if($venue){
            $message = 'Venue added successfully';
            $notification = array(
                'success' => $message
            );    
        } else {
            $message = 'Something went wrong';
            $notification = array(
                'error' => $message
            );
        }
        
        return redirect()->route('admin.venues.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Venue $venue)
    {
        return view('admin.venues.show', compact('venue'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venue $venue)
    {
        return view('admin.venues.edit', compact('venue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVenueRequest $request, Venue $venue)
    {
        $venue->update($request->all());

        if($venue){
            $message = 'Venue updated successfully';
            $notification = array(
                'success' => $message
            );    
        } else {
            $message = 'Something went wrong';
            $notification = array(
                'error' => $message
            );
        }
        
        return redirect()->route('admin.venues.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venue $venue)
    {
        if($venue->status == 1){
            $venue->status = 0;
            
            if($venue->update()){
                return response(['success', 200]);
            }
        } else {
            $venue->status = 1;

            if($venue->update()){
                return response(['success', 200]);
            }
        }
    }
}
