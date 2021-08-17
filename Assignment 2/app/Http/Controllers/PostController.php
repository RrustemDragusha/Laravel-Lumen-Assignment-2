<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comments;
use App\Models\Replies;
use Egulias\EmailValidator\Warning\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redis;

class PostController extends Controller
{


     public function store(Request $request){
          

           if(auth()->user()){

            $this->validate($request, [
                'title' => 'required',
                'description' => 'required'
            ]);

            $data = $request->only('title', 'description');

            $post = auth()->user()->posts()->create([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => auth()->user()->id
            ]);

            return response($post, 200);
           }else{
               return response()->json("Unauthorized",401);
           }

             
     }


   public function destroy(Request $request,$post)
   {


    $p = Post::find($post);
    if(!$p) return "Post not found";
         
        if(auth()->user()){
            if (auth()->user()->admin || auth()->user()->id == $p->user_id) {
                $p->delete();


                return "Post successfully deleted";
            } else {
                return "You are not allowed to delete this post";
            }
        }else{
            return response("Unauthorized",401);
        }



   } 


   public function edit(Request $request, $post){
       

         $p = Post::find($post);
                if (!$p) return "Post not found";

         if(auth()->user()){
            if (auth()->user()->admin || auth()->user()->id == $p->user_id) {

                $this->validate($request, [
                    'title' => 'required',
                    'description' => 'required'
                ]);

                $p->update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'user_id' => auth()->user()->id
                ]);

                return  response(['status' => "Post successfully updated", 'data' => $p]);
            } else {
                return "You are not allowed to Update this post";
            }
         }else{
             return response('Unathorized',401);
         }
         

   }



     public function reply(Request $request){
       
        //    -----------------------------------------

        if(auth()->user()){
            $this->validate($request, ['description' => 'required', 'post_id' => 'required']);

            $post = Post::find($request->post_id);
            if (!$post) return 'Post does not exists';

            $reply = Replies::create([
                'user_id' => auth()->user()->id,
                'post_id' => $request->post_id,
                'description' => $request->description
            ]);
            return response($reply, 200);

        }else{
            return response('Unauthorized',401);
        }

     }



   


       
   }















