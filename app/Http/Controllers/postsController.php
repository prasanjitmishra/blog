<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\Auth;
class postsController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
	
	/**
     * Show the list of posts.
     * 
     * @return view with data
     */
	public function list(Request $request)
	{
		$posts = App\Post::listPosts(Auth::id());
		if (empty($posts)) {
			$posts = array();
		}
		$user =  Auth::user();
		return view('posts.postlist',['data'=>$posts,'userType'=>$user->userType]);
		
		//return response()->json(['status' => 1, 'message' => '', 'data' => $posts]);;
	}
	
	/**
     * save data posted by user.
     *
     * @return \Illuminate\Http\Response
     */
	public function add(Request $request)
	{
		$requestData = array();
		
		$requestData['userId'] = Auth::id();
		$requestData['description'] = $request->description;
		
		
		if (App\Post::addPost($requestData)) {
			//return response()->json(['status' => 1, 'message' => '', 'data' => '']);
			return redirect('/listPosts');
		} else {
			return response()->json(['status' => 0, 'message' => 'can not save', 'data' => '']);
		}
	}
	
	/**
     * delete  post by user.
     *
     * @return \Illuminate\Http\Response
     */
	public function deletePost(Request $request)
	{
		
		
		if (App\Post::deletePost($request->id)) {
			//return redirect('/listPosts');
			return response()->json(['status' => 1, 'message' => '', 'data' => '']);
		} else {
			return response()->json(['status' => 0, 'message' => 'can not save', 'data' => '']);
		}
	}
	
	/**
     * delete  post by user.
     *
     * @return \Illuminate\Http\Response
     */
	public function updatePost(Request $request)
	{
		$requestData['description'] = $request->description;
		$requestData['id'] = $request->id;
		
		if (App\Post::updatePost($requestData)) {
			//return redirect('/listPosts');
			return response()->json(['status' => 1, 'message' => '', 'data' => '']);
		} else {
			return response()->json(['status' => 0, 'message' => 'can not save', 'data' => '']);
		}
	}
}
