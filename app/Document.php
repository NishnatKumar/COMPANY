<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = "documents";
    protected $appends= array('image');

    protected $fillable = [
        'documentsID', 'type', 'status', 'path', 'userID',
    ];

    public function getImageAttribute()
    {
        $path = $this->path;
       $files= explode('_',$path);
       if(count($files)!=0)
            return ["name"=>$files[1],"path"=>\URL::to('/')."/upload/doc/".$path];
    }


}
