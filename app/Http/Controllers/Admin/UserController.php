<?php
   
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;  
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMerchant;
use App\Models\UserProfile;   
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $user_role;

    public function __construct()
    {
        $this->middleware('auth');
        $roles = Config::get('constants.role');
        $this->user_role = $roles['user'];

        // echo $encrypted = Crypt::encryptString('16');
        // echo "===";
        // echo $decrypted = Crypt::decryptString($encrypted);die;
    }
  
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userList()
    {
        $data=[];
        $data['title'] = 'User List';
        $data['menu_item'] = 'user_list';
        
        return view('admin/users/list',$data);
    }
    public function getuserslist(Request $request){
        // echo "<pre>";print_r($request->all());die;
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");; // Rows display per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = ($columnName_arr[$columnIndex]['data']) ? $columnName_arr[$columnIndex]['data'] : 'email'; // Column name
        $columnSortOrder = ($order_arr[0]['dir']) ? $order_arr[0]['dir'] : "DESC"; // asc or desc
        $searchValue = ($search_arr['value']) ? $search_arr['value']:''; // Search value
        
        // Total records
        $totalRecords = User::select('count(*) as allcount')->where('role_id', $this->user_role);
        if($searchValue){
            $totalRecords->where('name', 'like', '%' .$searchValue . '%')->orWhere('email', 'like', '%' .$searchValue . '%');
        }
        $totalRecords = $totalRecords->count();

        //totalRecordswithFilter
        $totalRecordswithFilter = User::select('count(*) as allcount')->where('role_id', $this->user_role);
        if($searchValue){
            $totalRecordswithFilter->where('name', 'like', '%' .$searchValue . '%')->orWhere('email', 'like', '%' .$searchValue . '%');
        }
        $totalRecordswithFilter = $totalRecordswithFilter->count();
        
        // Fetch records
        $records = User::where('role_id', $this->user_role)->with('userprofile');
        if($searchValue){
            $records->where('name', 'like', '%' .$searchValue . '%')->orWhere('email', 'like', '%' .$searchValue . '%');
        }
        $records = $records->offset($start)->limit($rowperpage)->orderBy($columnName, $columnSortOrder)->get();
        
        $data_arr = array();
        foreach($records as $record){
            $id = $record->id;
            $name = $record->name;
            $email = $record->email;
            $status = $record->status;
            
            $phone = ($record->userprofile)?$record->userprofile->phone:'';
            $position = ($record->userprofile)?$record->userprofile->position:'';
    
            $data_arr[] = array(
              "responsive_id"=>$id,
              "id" => $id,
              "name" => $name,
              "email" => $email,
              "status" => ucfirst($status),
              "phone" => $phone,
              "position" => $position,
              "edit_url" => route('admin.useredit',['id'=>Crypt::encryptString($id)]),
              "assign_url" => route('admin.userassign',['id'=>Crypt::encryptString($id)])
            );
         }
        
        $response = array(
            "status"=>true,
            "draw" => intval($draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" =>$totalRecordswithFilter,
            "data" => $data_arr
         );
         return response()->json($response,200);
    }
    public function add(){
        $data=[];
        $data['title'] = 'User Add';
        $data['menu_item'] = 'user_list';
        return view('admin/users/add',$data);
    }
    public function add_user(Request $request){
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'position' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);
        if ($validator->fails()) {
            $error = $validator->errors();
            return response()->json([
                'message'=>'validation error',
                "status"=>false,
                'errors'=>$error
            ],400);
            // echo "<pre>";print_r($error);die;
        }
        $addUser = User::create([
                'name' => $input['first_name'].' '.$input['last_name'],
                'email' => $input['email'],
                'is_admin' =>1,
                'role_id' => $this->user_role,
                'password' => Hash::make($input['password']),
                // 'password' => Hash::make($input['first_name'].''.$input['last_name']),
                'secret_key' => null,
                'secret_password'=>null,
                'status'=>'active'
        ]);
        if($addUser){
            $addUserProfile = UserProfile::create([
                'user_id' => $addUser->id,
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'position' => $input['position'],
                'address' => $input['address'],
                'phone' => $input['phone'],
                
            ]);
            return response()->json([
                'message'=>'User Added',
                'redirect_url'=>route('admin.users'),
                "status"=>true
            ],200);
        }
    }
    /*** get user by id */
    public function edit($user_id){
        $user_id = Crypt::decryptString($user_id);
        $data=[];
        $data['title'] = 'User Add';
        $data['menu_item'] = 'user_list';
        $data['id'] = $user_id;
        $data['userData'] = User::where('id',$user_id)->with('userprofile')->first();
        // echo "<pre>";print_r($data['userData']['userprofile']);die;
        return view('admin/users/edit',$data);
    }
    public function update_user(Request $request){
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$input['id'],
            'password' => 'nullable|string|min:8',
            'position' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);
        if ($validator->fails()) {
            $error = $validator->errors();
            return response()->json([
                'message'=>'validation error',
                "status"=>false,
                'errors'=>$error
            ],400);
            // echo "<pre>";print_r($error);die;
        }
        $user = User::where('id',$input['id'])->first();
        $user->name = $input['first_name'].' '.$input['last_name'];
        $user->email = $input['email'];
        $user->status = $input['status'];
        if(!empty($input['password'])){
            $user->password = Hash::make($input['password']);
        }
        if($user->save()){
            $userProfile = UserProfile::where('user_id',$input['id'])->first();
            $userProfile->first_name = $input['first_name'];
            $userProfile->last_name = $input['last_name'];
            $userProfile->position = $input['position'];
            $userProfile->address = $input['address'];
            $userProfile->phone = $input['phone'];
            $userProfile->save();
            return response()->json([
                'message'=>'User Updated',
                'redirect_url'=>route('admin.users'),
                "status"=>true
            ],200);
        }
    }
    /***
     * 
     * user assign to merchant layout
     */
    public function user_assign($user_id){
        $user_id = Crypt::decryptString($user_id);
        $data=[];
        $data['title'] = 'User Assign';
        $data['menu_item'] = 'user_list';
        $data['id'] = $user_id;
        $data['merchantData'] = User::where('role_id','2')->where('status','active')->get();
        $data['selectedmerchantData'] = UserMerchant::where('user_id',$user_id)->with('users')->get();
        $selectedId = [];
        foreach($data['selectedmerchantData'] as $sm){
            $selectedId[]= $sm->merchant_id;
        }
        $data['selectedmerchantDataids'] = $selectedId;
        // echo "<pre>";print_r($data['selectedmerchantData']);die;
        return view('admin/users/assign',$data);
    }
    public function assign_merchant(Request $request){
        $input = $request->all();
        if($input['selected_id']){
            UserMerchant::where('user_id',$input['user_id'])->delete();
            foreach(explode(",",$input['selected_id']) as $user_id){
                //$ifExits = UserMerchant::where('user_id',$input['user_id'])->where('merchant_id',$user_id)->get();
                // if($ifExits->count() == 0){
                    UserMerchant::create([
                        'user_id' => $input['user_id'],
                        'merchant_id' => $user_id,
                    ]);
                // }   
            }
            return response()->json([
                'message'=>'User Added',
                'redirect_url'=>'',
                "status"=>true
            ],200);
        }else{
            UserMerchant::where('user_id',$input['user_id'])->delete();
            return response()->json([
                'message'=>'User removed',
                'redirect_url'=>'',
                "status"=>true
            ],200);
        }
        
    }
}