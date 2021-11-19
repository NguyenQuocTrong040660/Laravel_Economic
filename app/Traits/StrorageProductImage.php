<?php
 namespace App\Traits;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Storage;

 trait StrorageProductImage{

     public function storeuploadtrait(Request $request, $filedname ,$folderName){

         if ($request->hasFile($filedname)) {
             //lay ten file goc
             $file_name = $request->file($filedname)->getClientOriginalName();
             //noi luu duong dan storage va public\storage
             $path = $request->file($filedname)->storeAs('public/'.$folderName,$file_name);
             $dataUploadTraits =[
                 'file_name' => $file_name,
                 'file_path'=>Storage::url($path )

             ];
            return $dataUploadTraits;

         } else {
            return null;
         }


     }

     public function UploadtMultifile($file,$folderName){

             //lay ten file goc
             $file_name = $file->getClientOriginalName();
             //noi luu duong dan storage va public\storage
             $path = $file->storeAs('public/'.$folderName,$file_name);
             $dataUploadmuilfile =[
                 'file_name' => $file_name,
                 'file_path'=>Storage::url($path )
             ];
             return $dataUploadmuilfile;

     }



 };
