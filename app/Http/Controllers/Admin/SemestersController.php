<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semester;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreSemesterRequest;
use App\Http\Requests\UpdateSemesterRequest;

class SemestersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Semester::all();
            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $crudRoutePart = 'semesters';

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

        return view('admin.semesters.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.semesters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSemesterRequest $request)
    {
        $semester = Semester::create($request->all());
        if($semester){
            $message = 'Semester added successfully';
            $notification = array(
                'success' => $message
            );
        } else {
            $message = 'Something went wrong';
            $notification = array(
                'error' => $message
            );
        }

        return redirect()->route('admin.semesters.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Semester $semester)
    {
        return view('admin.semesters.show', compact('semester'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Semester $semester)
    {
        return view('admin.semesters.edit', compact('semester'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSemesterRequest $request, Semester $semester)
    {
        $semester->update($request->all());

        if($semester){
            $message = 'Semester updated successfully';
            $notification = array(
                'success' => $message
            );
        } else {
            $message = 'Something went wrong';
            $notification = array(
                'error' => $message
            );
        }

        return redirect()->route('admin.semesters.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Semester $semester)
    {
        if($semester->status == 1){
            $semester->status = 0;

            if($semester->update()){
                return response(['success', 200]);
            }
        } else {
            $semester->status = 1;

            if($semester->update()){
                return response(['success', 200]);
            }
        }
    }
}
