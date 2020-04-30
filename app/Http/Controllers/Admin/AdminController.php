<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DataTables;

class AdminController extends Controller
{
    public function index(){
        // dd('aaaaaaa');
    	return view('backend.dashboard.dashboard');	
    }

    public function showUsersDetaisl(Request $request)
    {
        return DataTables::of(User::with('userRoleDetails')->orderBy('id', 'DESC')->where('userType','!=' , 1)->get())
            ->addColumn('action', function ($data) {
            		if($data->blocked=='yes'){
            			 $btn = '<input data-id="'.$data->id.'" data-status="no" class="changeblocktype btn btn-primary btn-sm" type="button" data-onstyle="success" value="UnBlock" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" >';
        			}else if($data->blocked == 'no'){
        				 $btn = '<input data-id="'.$data->id.'" data-status="yes" class="changeblocktype btn btn-primary btn-sm" type="button" data-onstyle="success" value="Block"   data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" >';
        			}
                    $btn .= '&nbsp;&nbsp&nbsp';
                    $btn .= '<a href="javascript:void(0);" class="btn btn-danger btn-sm fa fa-trash deleteUsers" data-id="' . $data->id . '"></a>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn .= '<a style="margin:10px;" href="' . route('usersProfile',$data->id) . '" class="btn btn-warning fa fa-eye btn-sm"></a>';
                    if ($data->userType==2) {
                        $btn .= '<a style="margin:10px;" href="javascript:void(0);" class="btn btn-sm btn-success changeRate" data-id="' . $data->id . '" data-charge="' . $data->consultation_charge . '">Change rates</a>';
                    }
                    return $btn;

            })->addColumn('sn', function ($data) {
                static $i = 1;
                return $i++;
            })->addColumn('userType', function ($data) {
               $usersType = $data->userRoleDetails->role;
               return $usersType;
            })->addColumn('consultation_charge', function ($data) {
                $charge = $data->consultation_charge;
               if ($charge) {
                    return $charge;   
               }else{
                    return 'NA';
               }
            })->addColumn('profile_pic', function ($data) {
                if ($data->profile_pic) {
                    $image = '<img src="'.asset("images/$data->profile_pic").'" border="0" width="50" class="img-rounded" align="center" />';
                 return $image;
                }else{
                    return "N/A";
                }
            })
            ->rawColumns(['profile_pic','action'])
            ->make(true);
    }

    public function usersProfile($id){
    	$usersDetails = User::where('id',$id)->first();
    	return view('users.admin.usersprofile',compact('usersDetails'));
    }

    public function usersDelete($id){
    	$Users = User::find($id); 
		$Users->delete($id);
    }

    public function changeBlock(Request $request){
        $user = User::find($request->user_id);
        $user->blocked = $request->status;
        $user->save();
  
        return response()->json(['success'=>'Status change successfully.']);
    }

    public function consulCharge(Request $request){

        $id = $request->id;
        $this->validate($request, [
            'consultation_charge' => 'required',
        ],[
            'consultation_charge'=>'Consultation Charge field is required',
        ]);

        $store = User::where('id', $id)->first();
        $store->consultation_charge = $request->consultation_charge;
        $store->save();

        $request->session()->flash('success', 'Fees has been changed Successfully !!.');
        return redirect()->route('admin');
    }
}
