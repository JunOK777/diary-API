<?php

namespace App\Http\Controllers;

use ResponseBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\User;
use App\Maintask;
use App\Todaytask;


class ApiTestController extends Controller
{
    public function test() {
        $testData = [
            ["id" => "1", "title" => "foo"],
            ["id" => "2", "title" => "bar"],
            ["id" => "3", "title" => "baz"]
        ];

        $slackApiKey = 'xoxb-391796256259-522279542450-yEsA0jRwErElzpIR3iUHQTRm'; //上で作成したAPIキー
        $text = 'こんにちは';
        $text = urlencode('投稿されたよ。' . $text);
        $url = "https://slack.com/api/chat.postMessage?token=${slackApiKey}&channel=%23test&username=testbot&text=${text}&as_user=true";
        file_get_contents($url);
        return $testData;
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
        $body       = $data['content'];

        $post = new Maintask;
        $post->task_body  = $body;
        $post->like_count = "active";
        $post->save();

        $new_data = Maintask::all()->sortByDesc('id')->first();
        $data = $new_data;
        
        return $data; 
    }

    public function saveCheck(Request $request) {
        $id = $request['data'];
        Log::debug($id);
        $post = Maintask::where('id', $id)->first();
        
        if($post->like_count === "done"){
            $post->like_count = "active";
            $post->save();
        } else {
            $post->like_count = "done";
            $post->save();
        }
        return "true";
    }

    public function delTask(Request $request) {
        $id = $request['data'];
        Log::debug($id);
        $post = Maintask::where('id', $id)->first();
        $post->delete();

        return "true";
    }

    public function getAllTasks(Request $request) {

        $request = Maintask::all();
        return $request; 

    }
    public function  deleteTask(Request $request) {
        $post = Maintask::all()->sortByDesc('id')->first();
        $post->delete();

        return "true"; 
    }
    public function  sendSlack(Request $request) {
        $active_tasks = Maintask::where('like_count', 'active')->get();
        $done_tasks   = Maintask::where('like_count', 'done')->get();
        
        $active_data = null;
        $done_data   = null;
        
        foreach($active_tasks as $active_task){
            $new_task = "・".$active_task->task_body."\n";
            $active_data = $active_data.$new_task;
        }
        foreach($done_tasks as $done_task){
            $new_task = "・ ~".$done_task->task_body."~\n";
            $done_data = $done_data.$new_task;
        }
        $data = "Jun\n".$done_data.$active_data;
        Log::debug($data);

        $slackApiKey = 'xoxb-391796256259-522279542450-PnTZLbW8c4bhe6keEtgafMlO';
        $text = urlencode($data);
        $url = "https://slack.com/api/chat.postMessage?token=${slackApiKey}&channel=%23test&username=testbot&text=${text}&as_user=true";
        file_get_contents($url);



        return "true"; 
    }


   
}
// Log::debug($request);