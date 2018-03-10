<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    //
	protected $table = 'posts';
	protected $guarded = ['id'];
	protected $dates = ['deleted_at'];
	
	public static function listPosts($id)
	{
		return Post::where('userId',$id)->get();
	}
	
	public static function addPost($data)
	{
		return Post::create($data);
	}
	
	public static function updatePost($data)
	{
		return Post::where('id', $data["id"])->update($data);
	}
	
	public static function deletePost($id)
	{
		return Post::destroy($id);
	}
}
