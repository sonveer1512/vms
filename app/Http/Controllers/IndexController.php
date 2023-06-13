<?php

namespace App\Http\Controllers;

use App\Models\CityModel;
use App\Models\StateModel;
use App\Models\VisitorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
    public function get_state(Request $request)
    {
        $id = $request->id;
        $state = StateModel::where('country_id', $id)->get();
        $output = '<option value="" selected>Select State</option>';
        foreach ($state as $val) {
            $output .= '<option value="' . $val->id . '">' . $val->name . '</option>';
        }
        return response()->json(['code' => 201, 'output' => $output]);
    }

    public function get_city(Request $request)
    {
        $id = $request->id;
        $state = CityModel::where('state_id', $id)->get();
        $output = '<option value="" selected>Select City</option>';
        foreach ($state as $val) {
            $output .= '<option value="' . $val->id . '">' . $val->name . '</option>';
        }
        return response()->json(['code' => 201, 'output' => $output]);
    }

    public function add_visitors(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'contact' => 'required',
            'country_id' => 'required',

        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 401, 'message' => $validate->errors()->toArray()]);
        } else {
            $check = VisitorModel::where('email', $request->email)->where('contact', $request->contact)->first();
            if ($check) {
                return response()->json(['code' => 402, 'message' => 'Data Already Exist']);
            } else {
                $data['name'] = $request->name;
                $data['email'] = $request->email;
                $data['contact'] = $request->contact;
                $data['country'] = $request->country_id;
                $data['state'] = $request->state;
                $data['city'] = $request->city;
                if (!empty($request->file('uploaded_image'))) {
                    $file = $request->file('uploaded_image');
                    date_default_timezone_set('Asia/Kolkata');
                    $filename = date('YmdHi') . $file->getClientOriginalName();
                    $file->move(public_path('uploads/uploaded_image'), $filename);
                    $data['upload_image'] = $filename;
                }

                if(!empty($request->image))
                {
                $image = $request->image;
                $imageInfo = explode(";base64,", $image);
                $imgExt = str_replace('data:image/', '', $imageInfo[0]);      
                $image = str_replace(' ', '+', $imageInfo[1]);
                $imageName = $request->name.time().".".$imgExt;
                Storage::disk('public_feeds')->put($imageName, base64_decode($image));
                $data['camera_image'] = $imageName;
                }

                $data['terms_condition'] = $request->terms;
                $data['company_nature'] = $request->company_nature;
                $data['area_intrest'] = $request->area_intrest;
                $event_info = implode(',', $request->event_source);
                $data['event_info'] = $event_info;
                $data['vaccination_status'] = $request->vaccination;
                
                $insert_data = VisitorModel::insert($data);
                $id = DB::getPdo()->lastInsertId();
                if ($insert_data) {
                    return response()->json(['code' => 200, 'message' => 'Record Added' ,'id'=>$id]);
                } else {
                    return response()->json(['code' => 201, 'message' => 'Something Went Wrong']);
                }
            }
        }
    }

    public function thank_you($id)
    {
        $data['id'] = $id;
        return view('thank_you', $data);
    }
}
