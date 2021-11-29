<?php
   
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;  
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;   
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
class MerchantController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $merchant_role;

    public function __construct()
    {
        $this->middleware('auth');
        $roles = Config::get('constants.role');
        $this->merchant_role = $roles['merchant'];
    }
  
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function merchantList()
    {
        $data=[];
        $data['title'] = 'Merchants List';
        $data['menu_item'] = 'merchant_list';
        
        return view('admin/merchants/list',$data);
    }
    public function getmerchantslist(Request $request){

        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = ($columnName_arr[$columnIndex]['data']) ? $columnName_arr[$columnIndex]['data'] : 'email'; // Column name
        $columnSortOrder = ($order_arr[0]['dir']) ? $order_arr[0]['dir'] : "DESC"; // asc or desc
        $searchValue = ($search_arr['value']) ? $search_arr['value']:''; // Search value

        // Total records
        $totalRecords = User::select('count(*) as allcount')->where('role_id', $this->merchant_role);
        if($searchValue){
            $totalRecords->where('name', 'like', '%' .$searchValue . '%')->orWhere('email', 'like', '%' .$searchValue . '%');
        }
        $totalRecords = $totalRecords->count();

        //totalRecordswithFilter
        $totalRecordswithFilter = User::select('count(*) as allcount')->where('role_id', $this->merchant_role);
        if($searchValue){
            $totalRecordswithFilter->where('name', 'like', '%' .$searchValue . '%')->orWhere('email', 'like', '%' .$searchValue . '%');
        }
        $totalRecordswithFilter = $totalRecordswithFilter->count();

        // Fetch records
        $records = User::where('role_id', $this->merchant_role);
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
            $role_id = $record->role_id;
            $notification_url = $record->notification_url;
    
            $data_arr[] = array(
              "responsive_id"=>$id,
              "id" => $id,
              "name" => $name,
              "email" => $email,
              "status" => ucfirst($status),
              "role_id" => ($role_id == $this->merchant_role) ? "Merchant":"",
              "notification_url" => $notification_url,
              "edit_url" => route('admin.edit',['id'=>Crypt::encryptString($id)])
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
        $data['title'] = 'Merchants Add';
        $data['menu_item'] = 'merchant_list';
        return view('admin/merchants/add',$data);
    }
    public function add_merchant(Request $request){
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'notification_url' => 'required|url|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            // 'password' => 'required|string|min:8',
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
                'name' => $input['name'],
                'email' => $input['email'],
                'notification_url' => $input['notification_url'],
                'is_admin' => 0,
                'role_id' => $this->merchant_role,
                'password' => Hash::make($input['email']),
                'secret_key' => User::getsecrateKey(),
                'secret_password'=>User::getsecretPassword(),
                'status'=>'active'
        ]);
        if($addUser){
            return response()->json([
                'message'=>'Merchant Added',
                'redirect_url'=>route('admin.merchants'),
                "status"=>true
            ],200);
        }
    }
    /*** get merchant by id */
    public function edit($merchant_id){
        $merchant_id = Crypt::decryptString($merchant_id);
        $data=[];
        $data['title'] = 'Merchants Add';
        $data['menu_item'] = 'merchant_list';
        $data['id'] = $merchant_id;
        $data['merchantData'] = User::where('id',$merchant_id)->first();
        // echo "<pre>";print_r($data['merchantData']);die;
        return view('admin/merchants/edit',$data);
    }
    public function update_merchant(Request $request){
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'notification_url' => 'required|url|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$input['id'],
            // 'password' => 'nullable|string|min:8',
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
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->notification_url = $input['notification_url'];
        $user->status = $input['status'];
        if(!empty($input['password'])){
            $user->password = Hash::make($input['password']);
        }
        
        if($user->save()){
            return response()->json([
                'message'=>'Merchant Updated',
                'redirect_url'=>route('admin.merchants'),
                "status"=>true
            ],200);
        }
    }
}