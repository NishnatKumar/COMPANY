<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageUpload extends Model
{
     /**
     * File upload function
     * @param file
     * @param path
     * $this->saveImage($path,'sub');
     */
    static function saveImage($request,$path)
    {
        $destinationPath ='upload/'.$path; // upload path

        $fileName = str_replace('_', '-', $request->getClientOriginalName());
        $profileImage = date('YmdHis') . "_" .str_replace(' ','', $fileName) ;
        $request->move($destinationPath, $profileImage);
        return $profileImage;
    }
}
