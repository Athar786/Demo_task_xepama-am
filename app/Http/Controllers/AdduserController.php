<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\adduser;
use App\Subcategory;
use App\category;
use DB,File,Redirect,Response,Validator;



class AdduserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
        $this->middleware('auth');
     }

    public function index()
    {
        $users = adduser::all();
        $categories = category::all();
        $subcat = Subcategory::all();
           
        return view('Add',compact('users','categories','subcat'));
        
    }

    public function myform()
    {
        $states = DB::table('categories')->pluck('name','id')->all();
        return view('Add',compact('states'));
    }

    public function myformAjax($id)
    {
        $cities = DB::table('subcategories')->where('categories_id',$id)->pluck("name","id")->all();
        return json_encode($cities);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $this->authorize('create', adduser::class);
        
        $this->validate($request,[
            'name'=>['required','max:255','alpha:/^[A-Za-z]$/'],
            'number'=>['required','digits:10'],
            'address'=>['required','max:255'],
            'state'=>['required'], 
            //'filename'=>['required'],

        ]);

        // if($request->hasfile('filename'))
        // {
        //     foreach($request->file('filename') as $image)
        //     {
        //         $names = $image->getClientOriginalName();
        //         $image->move(public_path().'/image/',$names);
        //         $users[]=$names;
        //     }
        // }
       

        $Adduser_data = array(
            'name'=>$request->name,
            'number'=>$request->number,
            //'hobbies'=>$request->hobbies,
            //'filename'=>json_encode($users),
            'gender'=>$request->gender,
            'address'=>$request->address ,
            'state'=>$request->state,
            'city'=>$request->city 
              
        );

    adduser::create($Adduser_data);
    $users = adduser::all();
    return view('home',compact('users',$users));


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = DB::select('select * from adduser where id = ?',[$id]);
        return view('show',['users'=>$users]);
    }

    /**
     * Show the form for editing the specified resource.
     *

     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = adduser::findOrFail($id);
        $states = DB::table('categories')->pluck('name','id')->all();
        $cities = DB::table('subcategories')->where('categories_id',$id)->pluck("name","id")->all();
        return view('edit')->with(['users'=>$users,'states'=>$states,'cities'=>$cities]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = adduser::find($id);

        $user->name = $request->input('name');
        $user->number = $request->input('number');
        $user->state = $request->input('state');
        $user->city = $request->input('city');
        $user->address = $request->input('address');
        $user->update();
        
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, adduser $adduser)
    {
        $this->authorize('delete',$adduser);

        $deluser = adduser::find($id);
        $deluser->delete();
        return redirect('/home');
    }
}
