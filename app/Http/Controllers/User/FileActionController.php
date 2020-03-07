<?php

namespace App\Http\Controllers\User;

use App\FileActions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FileActionController extends Controller
{
    //
    public function store(Request $request)
    {
        request()->validate([
            'file' => 'required|mimes:doc,docx,pdf,txt,png,jpeg,jpg|max:5120'
        ]);

        if ($files = $request->file('file')) {
            $filePath = 'actionImage';
            $actionFile = auth()->user()->name . '-' . date('Y-m-d-H:i:s') . "." . $files->getClientOriginalExtension();
            $files->move($filePath, $actionFile);
        }


        $fileActions = new FileActions();
        $userId = auth()->user()->id;
        $uniqueHash = md5('lasg-' . $userId);

        $fileActions->user_id = $userId;
        $fileActions->unique_hash = $uniqueHash;
        $fileActions->image = $actionFile;
        $fileActions->steps = 1;
        $fileActions->status = 0;

        $fileActions->save();

        return redirect('/home')->withSuccess('Your upload has been recieved succesfully and we will get back to you shortly');
    }
}
