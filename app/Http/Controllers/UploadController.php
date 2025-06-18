<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    public function step1()
{
    $categories = \App\Models\Category::all();
    return view('upload.step1', compact('categories'));
}

    public function postStep2(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:102400|mimes:pdf,doc,docx,jpeg,png,xls,zip',
        ]);

        $file = $request->file('file');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(storage_path('app/tmp'), $filename);

        session([
            'tmp_upload_path' => 'tmp/' . $filename,
            'original_file_name' => $file->getClientOriginalName(),
        ]);
        return redirect()->route('upload.step2');
    }

    public function step2()
    {
        if (!session()->has('tmp_upload_path')) {
            return redirect()->route('upload.step1');
        }
    
        $categories = \App\Models\Category::all();
        return view('upload.step2', compact('categories')); // ✅ TRUYỀN BIẾN
    }

    public function postStep3(Request $request)
    {
        // ✅ Bước 1: Validate dữ liệu từ form
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string|max:1000',
        ]);
    
        // ✅ Bước 2: Lấy đường dẫn file tạm từ session
        $tmpPath = session('tmp_upload_path');
        $originalName = session('original_file_name');
        $fullTmpPath = storage_path('app/' . $tmpPath);
    
        // ❌ Nếu không có file tạm hoặc bị mất → quay lại bước 1
        if (!$tmpPath || !file_exists($fullTmpPath)) {
            logger()->error('Không tìm thấy file tạm: ' . $fullTmpPath);
            return redirect()->route('upload.step1')->with('error', 'Tệp tin không tồn tại hoặc đã hết hạn. Vui lòng thử lại.');
        }
    
        // ✅ Bước 3: Di chuyển file từ thư mục tạm → thư mục public/storage/documents
        $publicDir = storage_path('app/public/documents');
        if (!file_exists($publicDir)) {
            mkdir($publicDir, 0775, true);
        }
    
        $newPath = 'documents/' . basename($tmpPath);
        $destination = storage_path('app/public/' . $newPath);
        rename($fullTmpPath, $destination);
    
        // ✅ Bước 4: Lưu thông tin tài liệu vào DB
        $document = Document::create([
            'title'         => $request->title,
            'type'          => $request->type,
            'description'   => $request->description,
            'category_id'   => $request->category_id,
            'file_path'     => $newPath,
            'original_name' => $originalName,
            'user_id'       => Auth::id(),
            'is_approved' => false,
        ]);
    
        // ✅ Bước 5: Xóa session sau khi upload thành công
        session()->forget(['tmp_upload_path', 'original_file_name']);
    
        // ✅ Bước 6: Chuyển sang bước hoàn tất, hiển thị lại thông tin
        return view('upload.step3', [
            'file' => $newPath,
            'data' => $document
        ]);
    }
    
}
