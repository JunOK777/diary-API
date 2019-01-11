<?php

namespace App\Http\Controllers;

use ResponseBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\User;
use App\Favorite;
use App\Post;


class ApiTestController extends Controller
{
    public function test() {
        $testData = [
            ["id" => "1", "title" => "foo"],
            ["id" => "2", "title" => "bar"],
            ["id" => "3", "title" => "baz"]
        ];
        return $testData;
    }
    public function getFavorite(Request $request) {
        $a = Favorite::first();
        $favorite = $a->favorite;
        return $favorite;
    }
    public function removeFavorite(Request $request) {
        $a = Favorite::first();
        $a->favorite = "1";
        $a->save();
        return "true";
    }

    public function addFavorite(Request $request) {
        $a = Favorite::first();
        $a->favorite = "0";
        $a->save();
        return "true";
    }

    public function login(Request $request) {
        
        $email_value = $request['email'];
        $pass_value = $request['pass'];

        $admin_email = User::value("email");
        $admin_pass = User::value("password");

        if($email_value === $admin_email && $pass_value === $admin_pass){
            return "true";
        }
    }
    public function saveTask(Request $request) {
        // 1.送られたデータを保存
        
        $data       = $request['data'];

        $name       = $data['name'];
        $body       = $data['content'];

        $post = new Post;
        // Log::debug($request);
        $post->task_name  = $name;
        $post->task_body  = $body;
        $post->like_count = 0;
        $post->save();
        
        return "true"; 
    }

    public function saveLike(Request $request) {
        $id = $request['data'];

        $post = Post::where('id', $id)->first();
        
        if($post->like_count === "0"){
            $post->like_count = "action";
            $post->save();
        } else {
            $post->like_count = "0";
            $post->save();
        }
        Log::debug($post);
        return "true";
    }

    public function getAllTasks(Request $request) {

        $request = Post::all();
        return $request; 

    }
    public function  deleteTask(Request $request) {
        $post = Post::all()->sortByDesc('id')->first();
        $post->delete();

        return "true"; 

    }
   
}
// Log::debug($request);