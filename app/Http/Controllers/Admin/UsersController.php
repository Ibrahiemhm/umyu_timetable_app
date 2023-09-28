<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Validator;
use App\Http\Requests\StoreUserRequest;
use DB;
use Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = User::all();
            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $crudRoutePart = 'users';

                return view('partials.datatablesActions', compact(
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('image', function ($row) {
                return '<img src="' . $row->getFirstMediaUrl('images') . '" width="100" />';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->editColumn('age', function ($row) {
                return $row->age ? $row->age : "";
            });
            $table->editColumn('gender', function ($row) {
                return $row->gender ? $row->gender : "";
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? ($row->status === 1 ? "Enabled" : "Disabled") : "";
            });

            $table->rawColumns(['actions', 'image']);

            return $table->make(true);
            
        }

        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->age = $request->age;
            $user->gender = $request->gender;
            $user->password = Hash::make('password');
            $user->role = 'user';
            if ($request->hasFile('image')) {
                $media = $user->addMediaFromRequest('image')->toMediaCollection('images');
            }
            $user->save();

            DB::commit();
        } catch (\Exception $e){
            $message = 'Something went wrong'.$e->getMessage();
            $notification = array(
                'error' => $message
            );
            return back()->with($notification);
        }

        $notification = array(
            'message' => 'User added successfully'
        );
        return redirect()->route('admin.users.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
