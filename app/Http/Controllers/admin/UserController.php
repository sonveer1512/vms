<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\VisitorModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function list()
    {
        $data['list'] = VisitorModel::with('country_1','state_1','city_1')->where('flag', '!=', '2')->get();
        return view('admins/user/list',$data);
    }

    public function delete(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'id' => 'required',
            'table' => 'required',
            'type' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 400, 'message' => 'Something went wrong']);
        } else {

            if ($request->type == 'activate') {
                $savedata['flag'] = 0;
                $key = 'Activated';
            } else if ($request->type == 'deactivate') {
                $savedata['flag'] = 1;
                $key = 'Deactivated';
            } else if ($request->type == 'delete') {
                $savedata['flag'] = 2;
                $key = 'Deleted';
            } else {
                return response()->json(['code' => 400, 'message' => 'Something went wrong']);
            }

            $query = DB::table($request->table)->where('id', $request->id)->update($savedata);

            if ($query) {
                return response()->json(['code' => 200, 'message' => 'Data ' . $key . ' Successfully']);
            } else {
                return response()->json(['code' => 400, 'message' => 'Something went wrong']);
            }
        }
    }

    public function filter(Request $request)
    {
        $data['list'] =  VisitorModel::whereDate('created_at', '>=', "$request->start_date")->where('flag', '!=', '2')->orderBy('id', 'DESC')->get();

        if (!empty($request->start_date) && !empty($request->end_date)) {
            $data['list'] = $data['list']->whereBetween('created_at', ["$request->start_date", "$request->end_date",]);
        }

        if (!empty($request->active_inactive)) {
            $data['list'] = $data['list']->where('flag', $request->active_inactive);
        }
        return view('admins/user/filter', $data);
    }
}
