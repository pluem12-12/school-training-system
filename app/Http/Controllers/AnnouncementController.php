<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * แสดงรายการข่าวประชาสัมพันธ์
     */
    public function index()
    {
        $announcements = Announcement::published()
            ->pinnedFirst()
            ->paginate(10);

        return view('announcements.index', compact('announcements'));
    }

    /**
     * แสดงรายละเอียดข่าว
     */
    public function show(Announcement $announcement)
    {
        return view('announcements.show', compact('announcement'));
    }
}
