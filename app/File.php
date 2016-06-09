<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';
    protected $guarded = array();


    public static function store($request)
    {
      $file = File::firstOrNew(array('id'=>$request->id));
      $file->user_id = $request->user_id;
      $file->folder_id = $request->folder_id;
      $file->name = $request->name;
      $file->subject = $request->subject;
      $file->content = $request->content;
      $file->is_private = $request->is_private;
      $file->credential = $request->credential;
      $file->save();
      return $file;
    }
}
