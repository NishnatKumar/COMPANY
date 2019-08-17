<?php

namespace App\Http\Controllers\API;

use App\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\ImageUpload;
use App\ReturnData;
use App\User;

class DocumentController extends Controller
{
    /**Upload Documents */
    public function uploadDocument(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'document' => 'required',

            'type'=>'required',
            'userID'=>'required'


            ]);

            if ($validator->fails()) {
                        // return response()->json(['error'=>$validator->errors()], 401);
                        return ReturnData::returnData(false,$validator->errors()->first());
            }
        $doc = $request->file('document');
        $type= $request->type;
        $userID = $request->userID;
        $path="doc";

        $data= [
             'type'=>$type,
             'status'=>0,
              'userID'=>$userID,
        ];



        if($doc != null)
        {

             $image = ImageUpload::saveImage($doc,$path);
            $data["path"]=$image;

        }


        $data =	 Document::create($data);

       if($data!=null)
       {
        return ReturnData::returnData(true,$data);
       }
       else
       {
        return ReturnData::returnData(false,"Error ");
       }

    }

    /**Get Documents */
    public function getDocuments(Request $request)
    {
        $user = User::where('id',$request->userID)->first();



        $document = Document::where('userID',$request->userID)->get();




        return ReturnData::returnData(true,["document"=>$document,"user"=>$user]);


    }

     /**status Change */
     public function changeStatus(Request $request)
     {
         $document = Document::where("documentsID",$request->docID)->update(['status'=>$request->status]);
         return ReturnData::returnData(true,$document);

     }
}
