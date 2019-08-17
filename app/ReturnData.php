<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturnData extends Model
{
    public $successStatus = 200;

    public static function returnData($flag,$data)
    {
        if($flag)
            return response()->json(['success' => true,'data'=>$data], 200);
        else
            return response()->json(['success' => false,'msg'=>$data],200);
    }
}
