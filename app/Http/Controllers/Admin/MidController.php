<?php
   
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;  
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Mid;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use App\Helpers\Payretailers\Payretailer;
use Illuminate\Support\Facades\Log;
class MidController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
        
    }
  
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function midList()
    {
        $data=[];
        $data['title'] = 'MID List';
        $data['menu_item'] = 'mid_list';
        return view('admin/mids/list',$data);
    }
    public function getmidslist(Request $request){

        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = ($columnName_arr[$columnIndex]['data']) ? $columnName_arr[$columnIndex]['data'] : 'name'; // Column name
        $columnSortOrder = ($order_arr[0]['dir']) ? $order_arr[0]['dir'] : "asc"; // asc or desc
        $searchValue = ($search_arr['value']) ? $search_arr['value']:''; // Search value

        // Total records
        // $totalRecords = Mid::select('count(*) as allcount')->count();
        // Total records
        $totalRecords = Mid::select('count(*) as allcount');
        if($searchValue){
            $totalRecords->where('name', 'like', '%' .$searchValue . '%')->orWhere('connector', 'like', '%' .$searchValue . '%');
        }
        $totalRecords = $totalRecords->count();

        //totalRecordswithFilter
        $totalRecordswithFilter = Mid::select('count(*) as allcount');
        if($searchValue){
            $totalRecordswithFilter->where('name', 'like', '%' .$searchValue . '%')->orWhere('connector', 'like', '%' .$searchValue . '%');
        }
        $totalRecordswithFilter = $totalRecordswithFilter->count();      

        // Fetch records
        // $records = Mid::all();
        // Fetch records
        $records = Mid::orderBy($columnName, $columnSortOrder);
        if($searchValue){
            $records->where('name', 'like', '%' .$searchValue . '%')->orWhere('connector', 'like', '%' .$searchValue . '%');
        }
        $records = $records->offset($start)->limit($rowperpage)->get();

        $data_arr = array();
        $mid_connector = Config::get('constants.mid_connector');
        foreach($records as $record){
            $id = $record->id;
            $name = $record->name;
            $descriptor = $record->descriptor;
            $status = $record->status;
            
            $connector = $record->connector;
    
            $data_arr[] = array(
              "responsive_id"=>$id,
              "id" => $id,
              "name" => $name,
              "descriptor" => $descriptor,
              "status" => ucfirst($status),
              "connector" => $mid_connector[$connector],
              "edit_url" => route('admin.midedit',['id'=>Crypt::encryptString($id)]),
            );
        }
        
        
        // $response = array(
        //     "status"=>true,
        //     "draw" => intval($draw),
        //     "iTotalRecords" => $totalRecords,
        //     "iTotalDisplayRecords" => $totalRecordswithFilter,
        //     "aaData" => $data_arr
        //     // 'pagination'=>$pagination
        //  );
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
        $data['title'] = 'MID Add';
        $data['menu_item'] = 'mid_list';
        $data['mid_connector'] = Config::get('constants.mid_connector');
        return view('admin/mids/add',$data);
    }
    public function add_mid(Request $request){
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'descriptor' => 'required|max:255',
            'connector' => 'required',
            'status' => 'required',
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
        $addmid = Mid::create([
                'name' => $input['name'],
                'descriptor' => $input['descriptor'],
                'connector' => $input['connector'],
                'status'=>'active'
        ]);
        if($addmid){
            return response()->json([
                'message'=>'Mid Added',
                'redirect_url'=>route('admin.mids'),
                "status"=>true
            ],200);
        }
    }
    /*** get MID by id */
    public function edit($mid_id){
        $mid_id = Crypt::decryptString($mid_id);
        $data=[];
        $data['title'] = 'MID Edit';
        $data['menu_item'] = 'mid_list';
        $data['id'] = $mid_id;
        $data['mid_connector'] = Config::get('constants.mid_connector');
        $data['midData'] = Mid::where('id',$mid_id)->first();
        // echo "<pre>";print_r($data['midData']);die;
        return view('admin/mids/edit',$data);
    }
    public function update_mid(Request $request){
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'descriptor' => 'required|max:255',
            'connector' => 'required',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            $error = $validator->errors();
            return response()->json([
                'message'=>'validation error',
                "status"=>false,
                'errors'=>$error
            ],400);
            
        }
        $mid = Mid::where('id',$input['id'])->first();
        $mid->name = $input['name'];
        $mid->descriptor = $input['descriptor'];
        $mid->connector = $input['connector'];
        $mid->status = $input['status'];
        
        if($mid->save()){
            return response()->json([
                'message'=>'MID Updated',
                'redirect_url'=>route('admin.mids'),
                "status"=>true
            ],200);
        }
    }
    
}