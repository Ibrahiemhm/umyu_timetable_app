<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faculty;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreFacultyRequest;
use App\Http\Requests\UpdateFacultyRequest;

class FacultiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Faculty::all();
            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $crudRoutePart = 'faculties';

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
            $table->editColumn('status', function ($row) {
                return $row->status ? ($row->status == 1 ? "Enabled" : "Disabled") : "Disabled";
            });

            $table->rawColumns(['actions']);

            return $table->make(true);

        }

        return view('admin.faculties.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.faculties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFacultyRequest $request)
    {
        $faculty = Faculty::create($request->all());
        if($faculty){
            $message = 'Faculty added successfully';
            $notification = array(
                'success' => $message
            );
        } else {
            $message = 'Something went wrong';
            $notification = array(
                'error' => $message
            );
        }

        return redirect()->route('admin.faculties.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Faculty $faculty)
    {
        return view('admin.faculties.show', compact('faculty'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faculty $faculty)
    {
        return view('admin.faculties.edit', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFacultyRequest $request, Faculty $faculty)
    {
        $faculty->update($request->all());

        if($faculty){
            $message = 'Faculty updated successfully';
            $notification = array(
                'success' => $message
            );
        } else {
            $message = 'Something went wrong';
            $notification = array(
                'error' => $message
            );
        }

        return redirect()->route('admin.faculties.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faculty $faculty)
    {
        if($faculty->status == 1){
            $faculty->status = 0;

            if($faculty->update()){
                return response(['success', 200]);
            }
        } else {
            $faculty->status = 1;

            if($faculty->update()){
                return response(['success', 200]);
            }
        }
    }
}
