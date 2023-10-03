<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\CourseCategory;
use App\Models\Semester;
use App\Models\Course;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Course::all();
            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $crudRoutePart = 'courses';

                return view('partials.datatablesActions', compact(
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('department', function ($row) {
                return $row->department_id ? $row->department?->title : "";
            });
            $table->editColumn('course_category', function ($row) {
                return $row->course_category_id ? $row->courseCategory?->title : "";
            });
            $table->editColumn('semester', function ($row) {
                return $row->semester_id ? $row->semester?->title : "";
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : "";
            });
            $table->editColumn('course_code', function ($row) {
                return $row->course_code ? $row->course_code : "";
            });
            $table->editColumn('number_of_students', function ($row) {
                return $row->number_of_students ? $row->number_of_students : "";
            });
            
            $table->editColumn('status', function ($row) {
                return $row->status ? ($row->status == 1 ? "Enabled" : "Disabled") : "Disabled";
            });

            $table->rawColumns(['actions']);

            return $table->make(true);
            
        }

        return view('admin.courses.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::where('status', 1)->select('id', 'title')->get();
        $course_categories = CourseCategory::where('status', 1)->select('id', 'title')->get();
        $semesters = Semester::where('status', 1)->select('id', 'title')->get();

        return view('admin.courses.create', compact('departments', 'course_categories', 'semesters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        $course = Course::create($request->all());
        if($course){
            $message = 'Course added successfully';
            $notification = array(
                'success' => $message
            );    
        } else {
            $message = 'Something went wrong';
            $notification = array(
                'error' => $message
            );
        }
        
        return redirect()->route('admin.courses.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view('admin.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        if($course->department->status == 0 || $course->courseCategory->status == 0 || $course->semester->status == 0){
            $message = 'Either department, course category or semester is disabled, can not make changes to the selected course';
            $notification = array(
                'error' => $message
            );

            return redirect()->back()->with($notification);
        } else {
            $departments = Department::where('status', 1)->select('id', 'title')->get();
            $course_categories = CourseCategory::where('status', 1)->select('id', 'title')->get();
            $semesters = Semester::where('status', 1)->select('id', 'title')->get();

            return view('admin.courses.edit', compact('course', 'departments', 'course_categories', 'semesters'));    
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->all());

        if($course){
            $message = 'Course updated successfully';
            $notification = array(
                'success' => $message
            );    
        } else {
            $message = 'Something went wrong';
            $notification = array(
                'error' => $message
            );
        }
        
        return redirect()->route('admin.courses.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        if($course->status == 1){
            $course->status = 0;
            
            if($course->update()){
                return response(['success', 200]);
            }
        } else {
            $course->status = 1;

            if($course->update()){
                return response(['success', 200]);
            }
        }
    }
}
