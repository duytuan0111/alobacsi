<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

trait StorageImageTrait
{
    public function StorageTraitUpload($request, $fieldName, $folderName)
    {
        if ($request->hasFile($fieldName)) {
            $file                   = $request->$fieldName;
            $fileNameOrigin         = $file->getClientOriginalName();
            $fileNameHash           = str_random(20) . '.' . $file->getClientOriginalExtension();    // rename image
            $fileName               = $request->$fieldName->getClientOriginalName(); // get name fileUpload
            $filePath               = $request->file($fieldName)->storeAs('/public/' . $folderName . '/' . Auth::user()->id, $fileNameHash);
            $dataUploadTrait     = [
                'file_name'    => $fileNameOrigin,
                'file_path'    => Storage::url($filePath)
            ];
            return $dataUploadTrait;
        }
        return null;
    }

    public function StorageTraitUploadMultiple($file, $folderName) {
        $fileNameOrigin     = $file->getClientOriginalName();
        $fileNameHash       = str_random(20).'.'.$file->getClientOriginalExtension(); // // rename image
        $fileName 		    = $file->getClientOriginalName(); // get name fileUpload
        $filePath 		    = $file->storeAs('/public/'.$folderName.'/'.auth()->id(), $fileNameHash);
        $dataUploadTrait 	= [
            'file_name'	=> $fileNameOrigin,
            'file_path'	=> Storage::url($filePath)
        ];
        return $dataUploadTrait;
    }  
}
