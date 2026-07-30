<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\TrainingSchedule;
use App\Models\AboutContent;
use App\Models\Agency;
use App\Models\Document;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $announcements = Announcement::published()
            ->pinnedFirst()
            ->take(6)
            ->get();

        $universitySchedules = TrainingSchedule::active()
            ->university()
            ->upcoming()
            ->take(4)
            ->get();
            
        $facultySchedules = TrainingSchedule::active()
            ->faculty()
            ->upcoming()
            ->take(4)
            ->get();

        $about = AboutContent::first();
        $agencies = Agency::all();
        
        $uniCalendarSetting = \App\Models\CalendarSetting::where('category', 'university')->first();
        $facCalendarSetting = \App\Models\CalendarSetting::where('category', 'faculty')->first();
        
        // ดึงเอกสาร 10 รายการล่าสุด
        $documents = Document::orderByDesc('is_pinned')->latest()->take(10)->get();

        $siteSetting = \App\Models\SiteSetting::first();
        $quickLinks = \App\Models\FooterLink::where('category', 'quick_link')->orderBy('sort_order')->get();
        $contactLinks = \App\Models\FooterLink::where('category', 'contact')->orderBy('sort_order')->get();

        return view('welcome', compact('announcements', 'universitySchedules', 'facultySchedules', 'about', 'agencies', 'documents', 'uniCalendarSetting', 'facCalendarSetting', 'siteSetting', 'quickLinks', 'contactLinks'));
    }
}
