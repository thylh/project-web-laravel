<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::where('is_approved', true)->orderByDesc('id')->paginate(6);
        return view('Tailieu-Dethi.document', compact('documents'));
    }
    public function view($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem tài liệu.');
        }
        $document = Document::findOrFail($id);

        if (!Storage::disk('public')->exists($document->file_path)) {
            abort(404, 'Tài liệu không tồn tại.');
        }

        return view('Tailieu-Dethi.viewer', [
            'document' => $document,
            'fileUrl' => asset('storage/' . $document->file_path)
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
