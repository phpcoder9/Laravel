<?php
/**
 * @package Helper
 * @description UploadFile Helper upload one file only and return  file and also location ;
 * @param string $
*/

function UploadFile($request,$file,$folder,$location = false){
    $public_path = public_path('');
    if($request->hasFile($file)){
        $file = $request->file($file);
        $name = $file->getClientOriginalName();
        $file->move($public_path.'/'.$folder,$name);
        return $name;
    }
    return null;
}

function UploadManyFile($request, $file, $folder,$location=false) {
    $public_path = public_path('');
    if ($request->hasFile($file)) {
        $files = $request->file($file);
        $uploadedFiles = [];
        foreach ($files as $file) {
            $name = $file->getClientOriginalName();
            $file->move($public_path . '/' . $folder, $name);
            $uploadedFiles[] = $name;
        }
        return $uploadedFiles;
    }
    return null;
}

