<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
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
            $query = User::withTrashed();
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
            $table->editColumn('department', function ($row) {
                return $row->department_id ? $row->department?->title : "";
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? ($row->status == 1 ? "Enabled" : "Disabled") : "Disabled";
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
        $departments = Department::where('status', 1)->select('id', 'title')->get();

        return view('admin.users.create', compact('departments'));
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
            $user->department_id = $request->department_id;
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
            'success' => 'User added successfully.'
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
        if($user->department->status == 0){
            $message = 'Department is disabled, can not make changes to the selected user';
            $notification = array(
                'error' => $message
            );

            return redirect()->back()->with($notification);
        } else {
            $departments = Department::where('status', 1)->select('id', 'title')->get();

            return view('admin.users.edit', compact('user', 'departments'));  
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest  $request, User $user)
    {
        DB::beginTransaction();

        try {
            // Update user information
            $user->name = $request->name;
            $user->email = $request->email;
            $user->age = $request->age;
            $user->gender = $request->gender;
            $user->department_id = $request->department_id;

            // Check if a new image is uploaded
            if ($request->hasFile('image')) {
                // Delete the current image if it exists
                if ($user->getFirstMedia('images')) {
                    $user->getFirstMedia('images')->delete();
                }

                // Add and store the new image
                $media = $user->addMediaFromRequest('image')->toMediaCollection('images');
            }

            $user->save();

            DB::commit();
        } catch (\Exception $e) {
            // Handle exceptions
            DB::rollBack();

            $message = 'Something went wrong: ' . $e->getMessage();
            $notification = [
                'error' => $message,
            ];

            return back()->with($notification);
        }

        $notification = [
            'success' => 'User updated successfully.',
        ];

        return redirect()->route('admin.users.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->withTrashed()->first();

        if($user->status == 1){
            $user->status = 0;
            $user->update();
            
            if($user->delete()){
                return response(['success', 200]);
            }    
        } else {
            $user->status = 1;
            $user->deleted_at = null;
            $user->update();

            return response(['success', 200]);
        }
        
    }
}
