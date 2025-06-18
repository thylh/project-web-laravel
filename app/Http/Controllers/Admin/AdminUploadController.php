<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;

class AdminUploadController extends Controller
{
    

    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }
    
        $categories = \App\Models\Category::all(); // ✅ THÊM DÒNG NÀY
    
        return view('admin.upload', compact('categories'));
    }
    
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Bạn không có quyền truy cập chức năng này.');
        }
    
        $request->validate([
            'file' => 'required|file|max:102400|mimes:pdf,doc,docx,jpeg,png,xls,zip',
            'title' => 'required|string|max:255',
            'type' => 'required|string',
            'category_id' => 'required|exists:categories,id', // ✅ validate danh mục
            'description' => 'nullable|string',
        ]);
    
        $file = $request->file('file');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('documents', $filename, 'public');
    
        Document::create([
            'title' => $request->title,
            'type' => $request->type,
            'description' => $request->description,
            'category_id' => $request->category_id, // ✅ lưu danh mục
            'file_path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'user_id' => Auth::id(),
            'is_approved' => true,
        ]);
    
        return redirect()->back()->with('success', 'Tải lên thành công!');
    }
    
}
