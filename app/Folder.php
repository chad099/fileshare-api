<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Folder;
class Folder extends Model
{
    protected $table = 'folders';
    protected $guarded = array();

    public static function store($request){
      $folder = Folder::firstOrNew(array('id'=>$request->id));
      $folder->name = $request->name;
      $folder->user_id = $request->user_id;
      $folder->description = $request->description;
      $folder->save();
      return $folder;
    }
}
