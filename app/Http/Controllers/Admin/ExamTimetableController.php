<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamTimetable;
use App\Models\Course;
use App\Models\Venue;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreExamTimetableRequest;
use App\Http\Requests\UpdateExamTimetableRequest;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class ExamTimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = ExamTimetable::all();
            $table = Datatables::of($query);

            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $crudRoutePart = 'exam-timetable';

                return view('partials.datatablesActions', compact(
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('course', function ($row) {
                return $row->course ? $row->course->title : "";
            });
            $table->editColumn('date', function ($row) {
                return $row->date ? $row->date : "";
            });
            $table->editColumn('start_time', function ($row) {
                return $row->start_time ? $row->start_time : "";
            });
            $table->editColumn('end_time', function ($row) {
                return $row->end_time ? $row->end_time : "";
            });
            $table->editColumn('venue', function ($row) {
                return $row->venue ? $row->venue->title : "";
            });

            $table->rawColumns(['actions']);

            return $table->make(true);
            
        }

        return view('admin.exam-timetable.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::where('status', 1)->select('id', 'title')->get();
        $venues = Venue::where('status', 1)->select('id', 'title')->get();

        return view('admin.exam-timetable.create', compact('courses', 'venues'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExamTimetableRequest $request)
    {
        $exists = $this->checkForDuplicates($request);
        // dd($exists);
        if($exists === true){
            $message = 'Duplicate entry found! Choose another date, venue or timeslot';
            $notification = array(
                'error' => $message
            );

            return redirect()->back()->with($notification);
        } else {
            $examTimetable = ExamTimetable::create($request->all());
            
            if($examTimetable){
                $message = 'Exam Timetable added successfully';
                $notification = array(
                    'success' => $message
                );    
            } else {
                $message = 'Something went wrong';
                $notification = array(
                    'error' => $message
                );
            }    
        }
        
        
        return redirect()->route('admin.exam-timetable.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function checkForDuplicates(Request $request)
    {
        $exists = ExamTimetable::where('course_id', $request->course_id)
                           ->where('venue_id', $request->venue_id)
                           ->where('date', $request->date)
                           ->where('start_time', '<=', $request->start_time)
                           ->where('end_time', '>=', $request->end_time)
                           ->exists();

        return response()->json(['exists' => $exists]);
    }

    public function show(ExamTimetable $examTimetable)
    {
        return view('admin.exam-timetable.show', compact('examTimetable'));
    }

    public function showTimetable()
    {
        // Get the earliest and latest dates from the timetable entries
    $startDate = ExamTimetable::min('date');
    $endDate = ExamTimetable::max('date');

    // Create a date range from the earliest to the latest date
    $dateRange = CarbonPeriod::create($startDate, $endDate);

    // Get distinct time slots (hours) from the start_time field
    $timeSlots = ExamTimetable::selectRaw('TIME_FORMAT(start_time, "%H:%i") as start_time, TIME_FORMAT(end_time, "%H:%i") as end_time')
                       ->distinct()
                       ->orderBy('start_time')
                       ->orderBy('end_time')
                       ->get()
                       ->map(function ($slot) {
                           return $slot->start_time . ' - ' . $slot->end_time;
                       })
                       ->all();

    // Initialize the timetable matrix
    $timetableMatrix = [];
    foreach ($dateRange as $date) {
    foreach ($timeSlots as $timeSlot) {
        $timetableMatrix[$date->format('Y-m-d')][$timeSlot] = [];
    }
}

    // Populate the matrix with timetable data
    $timetables = ExamTimetable::with(['course', 'venue'])->get();
    foreach ($timetables as $timetable) {
    $date = Carbon::parse($timetable->date)->format('Y-m-d');
    $timeSlotKey = Carbon::parse($timetable->start_time)->format('H:i') . ' - ' . Carbon::parse($timetable->end_time)->format('H:i');

    if (isset($timetableMatrix[$date][$timeSlotKey])) {
        $timetableMatrix[$date][$timeSlotKey][] = $timetable;
    }
}

        return view('admin.exam-timetable.view', compact('timetableMatrix', 'timeSlots'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExamTimetable $examTimetable)
    {
        return view('admin.exam-timetable.edit', compact('examTimetable'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExamTimetableRequest $request, ExamTimetable $examTimetable)
    {
        $examTimetable->update($request->all());

        if($examTimetable){
            $message = 'Exam Timetable updated successfully';
            $notification = array(
                'success' => $message
            );    
        } else {
            $message = 'Something went wrong';
            $notification = array(
                'error' => $message
            );
        }
        
        return redirect()->route('admin.exam-timetable.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExamTimetable $examTimetable)
    {
        if($examTimetable->status == 1){
            $examTimetable->status = 0;
            
            if($examTimetable->update()){
                return response(['success', 200]);
            }
        } else {
            $examTimetable->status = 1;

            if($examTimetable->update()){
                return response(['success', 200]);
            }
        }
    }
}
