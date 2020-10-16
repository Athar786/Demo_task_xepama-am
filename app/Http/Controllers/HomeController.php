<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\adduser;
use DB;
use Auth;
use Illuminate\Pagination\Paginator;


class HomeController extends Controller
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
    public function index(Request $request)
    {
            // $users = adduser::all();
            // $users = adduser::paginate(5);
            // return view('home',compact('users',$users));

            if(empty($request->all()))
            {
                $users = adduser::all();
                $users = adduser::paginate(5);
                return view('home',compact('users',$users));
            } else{
                $search = $request->search;
                $users = DB::table('adduser')->Where('name','LIKE','%'.$search.'%')
                ->orWhere('gender','LIKE','%'.$search.'%')
                ->orWhere('number','LIKE','%'.$search.'%')
                ->orWhere('city','LIKE','%'.$search.'%')
                ->orWhere('address','LIKE','%'.$search.'%')->paginate(5);
                $users->appends($request->all());
                return view('home',compact('users',$users));
            }
    
            
    }

    // function search(Request $request)
    // {
    //     if($request->ajax())
    //     {
    //         $output = "";
    //         $query = $request->get('query');
    //         if($query != '')
    //         {           
    //             $data = DB::table('adduser')->Where('name','LIKE','%'.$query.'%')
    //                 ->orWhere('gender','LIKE','%'.$query.'%')
    //                 ->orWhere('number','LIKE','%'.$query.'%')
    //                 ->orWhere('city','LIKE','%'.$query.'%')
    //                 ->orWhere('address','LIKE','%'.$query.'%')->get();
    //         } else {
    //                 $data = DB::table('adduser')->orderBy('id','desc')->get();
    //             }
    //         $total_row = $data->count();
    //         if($total_row > 0)
    //         {
    //             foreach($data as $row)
    //             {
    //                 $output .= '
    //                     <tr>
    //                     <td>'.$row->id.'</td>
    //                     <td>'.$row->name.'</td>
    //                     <td>'.$row->number.'</td>
    //                     <td>'.$row->gender.'</td>
    //                     <td>'.$row->address.'</td>
    //                     <td>'.$row->city.'</td>
    //                     </tr>
    //                     ';
    //             }
    //         } else {
    //             $output = '
    //                 <tr>
    //                     <td align="center" colspan="5">No Data Found</td>
    //                 </tr>
    //                 ';
    //         }
    //         $data = array(
    //             'table_data' => $output
    //         );
    //         echo json_encode($data);           
    //     }
    // }

    
}