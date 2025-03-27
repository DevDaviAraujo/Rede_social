<?php

namespace App\Http\Controllers\Auth\WebsiteControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Content;
class WebsiteController extends Controller
{
    public function home() {

        $posts = Content::Where('content_id', null)->get();

        return view('website.home',['posts' => $posts]);
    }

    public function login() {
        return view('website.login');
    }
    public function register() {
        return view('website.register');
    }
    public function user($user_nickname) {

        $user = User::where('nick_name', $user_nickname)->first();

        if($user) {
            return view('website.user',['user' => $user]);
        } else {
            return view('errors.404');
        }

        
    }

    public function post($id) {

        $post = Content::where('id', $id)->where('content_type','Post')->first();

        if($post) {
            return view('website.post',['post' => $post]);
        } else {
            return view('errors.404');
        }

        
    }
}
