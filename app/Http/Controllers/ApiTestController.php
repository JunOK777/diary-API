<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiTestController extends Controller
{
    public function login()
    {
        $testData = [
            ["id" => "1", "title" => "foo"],
            ["id" => "2", "title" => "bar"],
            ["id" => "3", "title" => "baz"]
        ];
    
        return $testData;
    }
}
