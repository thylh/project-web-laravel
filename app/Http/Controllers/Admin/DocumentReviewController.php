<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentReviewController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Bạn không có quyền truy cập.');
        }

        $documents = Document::where('is_approved', false)->get();;
        return view('admin.dashboard-document', compact('documents'));
    }

    public function approve($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Bạn không có quyền truy cập.');
        }

        $document = Document::findOrFail($id);
        $document->is_approved = true;
        $document->save();

        return redirect()->back()->with('success', 'Tài liệu đã được duyệt.');
    }

    public function reject($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Bạn không có quyền truy cập.');
        }
        $document = Document::findOrFail($id);
        if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }
        $document->delete();
        return redirect()->back()->with('error', 'Tài liệu đã bị từ chối và xoá.');
    }
    public function approved()
   {
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        abort(403);
    }

    $documents = Document::where('is_approved', true)->get();

    return view('admin.documents-approved', compact('documents'));
   }
   public function destroy($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }

        $document = Document::findOrFail($id);

        // Xoá file thực nếu tồn tại
        if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return redirect()->back()->with('success', 'Tài liệu đã xoá thành công.');
    }
}
