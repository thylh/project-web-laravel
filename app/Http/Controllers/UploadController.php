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
        return view('upload.step1');
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
        return view('upload.step2');
    }

    public function postStep3(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $tmpPath = session('tmp_upload_path');
        $originalName = session('original_file_name');

        $fullTmpPath = storage_path('app/' . $tmpPath);

        if (!$tmpPath || !file_exists($fullTmpPath)) {
            logger('Không tìm thấy file tạm: ' . $fullTmpPath);
            return redirect()->route('upload.step1')->with('error', 'Tệp tin không tồn tại, vui lòng thử lại');
        }
        $publicDocumentsPath = storage_path('app/public/documents');
        if (!file_exists($publicDocumentsPath)) {
            mkdir($publicDocumentsPath, 0775, true);
        }

        $newPath = 'documents/' . basename($tmpPath);
        $destination = storage_path('app/public/' . $newPath);
        rename($fullTmpPath, $destination);

        $document = Document::create([
            'title' => $request->title,
            'type' => $request->type,
            'description' => $request->description,
            'file_path' => $newPath,
            'original_name' => $originalName,
            'user_id' => Auth::id(),
        ]);

        session()->forget(['tmp_upload_path', 'original_file_name']);

        return view('upload.step3', ['file' => $newPath, 'data' => $document]);
    }
}
