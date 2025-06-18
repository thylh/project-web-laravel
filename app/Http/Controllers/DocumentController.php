<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DocumentController extends Controller
{
    // public function index()
    // {
    //     $documents = Document::where('is_approved', true)->orderByDesc('id')->paginate(6);
    //     return view('Tailieu-Dethi.document', compact('documents'));
    // }
    public function index(Request $request)
{
    $categories = \App\Models\Category::all();
    $categoryId = $request->input('category_id');

    $query = Document::where('is_approved', true);

    if ($categoryId) {
        $query->where('category_id', $categoryId);
    }

    $documents = $query->orderByDesc('id')->paginate(6);

    return view('Tailieu-Dethi.document', compact('documents', 'categories', 'categoryId'));
}

    public function view($id)
    {
        // if (!Auth::check()) {
        //     return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem tài liệu.');
        // }
        // $document = Document::findOrFail($id);

        // if (!Storage::disk('public')->exists($document->file_path)) {
        //     abort(404, 'Tài liệu không tồn tại.');
        // }

        // return view('Tailieu-Dethi.viewer', [
        //     'document' => $document,
        //     'fileUrl' => asset('storage/' . $document->file_path)
        // ]);
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem tài liệu.');
        }
    
        $document = Document::with('category', 'user')->findOrFail($id);
    
        if (!Storage::disk('public')->exists($document->file_path)) {
            abort(404, 'Tài liệu không tồn tại.');
        }
    
        $categories = \App\Models\Category::all();
    
        // Lấy các tài liệu liên quan (cùng category, đã duyệt, trừ chính nó)
        $relatedDocs = Document::where('category_id', $document->category_id)
            ->where('is_approved', true)
            ->where('id', '!=', $document->id)
            ->limit(5)
            ->get();
    
        return view('Tailieu-Dethi.viewer', [
            'document' => $document,
            'fileUrl' => asset('storage/' . $document->file_path),
            'categories' => $categories,
            'relatedDocs' => $relatedDocs,
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $documents = Document::where('title', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->orWhere('type', 'LIKE', "%{$query}%")
            ->get();

        return view('Tailieu-Dethi.search', compact('documents', 'query'));
    }
}
