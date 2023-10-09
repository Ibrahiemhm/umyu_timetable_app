<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicSession;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreAcademicSessionRequest;
use App\Http\Requests\UpdateAcademicSessionRequest;
use Carbon\Carbon;

class AcademicSessionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = AcademicSession::all();
            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $crudRoutePart = 'academic-sessions';

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
            $table->editColumn('start_date', function ($row) {
                return $row->start_date ? $row->start_date : "";
            });
            $table->editColumn('end_date', function ($row) {
                return $row->end_date ? $row->end_date : "";
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? ($row->status == 1 ? "Enabled" : "Disabled") : "Disabled";
            });

            $table->rawColumns(['actions']);

            return $table->make(true);
            
        }

        return view('admin.academic-sessions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.academic-sessions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAcademicSessionRequest $request)
    {
        $academicSession = AcademicSession::create($request->all());
        if($academicSession){
            $message = 'Academic Session added successfully';
            $notification = array(
                'success' => $message
            );    
        } else {
            $message = 'Something went wrong';
            $notification = array(
                'error' => $message
            );
        }
        
        return redirect()->route('admin.academic-sessions.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(AcademicSession $academicSession)
    {
        return view('admin.academic-sessions.show', compact('academicSession'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcademicSession $academicSession)
    {
        return view('admin.academic-sessions.edit', compact('academicSession'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAcademicSessionRequest $request, AcademicSession $academicSession)
    {
        $academicSession->update($request->all());

        if($academicSession){
            $message = 'Academic session updated successfully';
            $notification = array(
                'success' => $message
            );    
        } else {
            $message = 'Something went wrong';
            $notification = array(
                'error' => $message
            );
        }
        
        return redirect()->route('admin.academic-sessions.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicSession $academicSession)
    {
        if($academicSession->status == 1){
            $academicSession->status = 0;
            
            if($academicSession->update()){
                return response(['success', 200]);
            }
        } else {
            $academicSession->status = 1;

            if($academicSession->update()){
                return response(['success', 200]);
            }
        }
    }
}
