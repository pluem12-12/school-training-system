<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * แสดงหน้าปฏิทินการฝึก
     */
    public function index()
    {
        $universitySchedules = \App\Models\TrainingSchedule::active()
            ->university()
            ->orderBy('start_date', 'asc')
            ->get();
            
        $facultySchedules = \App\Models\TrainingSchedule::active()
            ->faculty()
            ->orderBy('start_date', 'asc')
            ->get();
            
        $uniCalendarSetting = \App\Models\CalendarSetting::where('category', 'university')->first();
        $facCalendarSetting = \App\Models\CalendarSetting::where('category', 'faculty')->first();

        return view('calendar.index', compact('universitySchedules', 'facultySchedules', 'uniCalendarSetting', 'facCalendarSetting'));
    }
}
