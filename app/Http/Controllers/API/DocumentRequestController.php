<?php

namespace App\Http\Controllers\API;

use App\DocumentRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ReturnData;
use Validator;

class DocumentRequestController extends Controller
{
    public function storeRequest(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'month' => 'required',
            'userID'=>'required'


            ]);

            if ($validator->fails()) {
                        // return response()->json(['error'=>$validator->errors()], 401);
                        return ReturnData::returnData(false,$validator->errors()->first());
            }

            $month = $request->month;
            $userID = $request->userID;

            $data =['userID'=>$userID,
                    'months'=>$month
                    ];
            $data =DocumentRequest::create($data);

            if($data!= null)
            {
                return ReturnData::returnData(true,$data);
            }
            else
            {
                return ReturnData::returnData(false,'Something Error');
            }
    }

    //
    public function getRequest(Request $request)
    {
        $userID = $request->userID;

        $data = DocumentRequest::where('userID',$userID)->get();

        return ReturnData::returnData(false,$data);

    }
}
