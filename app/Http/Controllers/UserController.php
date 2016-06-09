<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator,App\User, App\Folder;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     protected function validator(array $data,$rules)
     {
         return Validator::make($data,$rules);
     }

    public function index()
    {
        echo  "I AM INDEX";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
          'name' => 'required|max:255',
          'email' => 'required|email|max:255|unique:users',
          'password' => 'required|min:6',
          'confirm_password' => 'required|min:6|same:password',
        ];
        $v = $this->validator($request->all(),$rules);
        if($v->fails())
          return response()->json(['errors'=>$v->getMessageBag()->toArray()], 400);


          //return json_encode(['status'=>'error','errors'=>$v->getMessageBag()->toArray()]);

        return $this->userInsertEdit($request);

    }

    public function userInsertEdit($request){
      return User::store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getUserFolders($userID){
        $folders = Folder::where('user_id',$userID)->get();
        return json_encode($folders);
    }
}
