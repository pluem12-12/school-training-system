<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * แสดงหน้ารายการดาวน์โหลดเอกสารทั้งหมด
     */
    public function index()
    {
        $documents = Document::orderBy('created_at', 'desc')->get();
        return view('documents.index', compact('documents'));
    }
}
