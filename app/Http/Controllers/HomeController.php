<?php

namespace App\Http\Controllers;

use App\User;
use App\UserPost;
use http\Env\Response;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
     * @return Renderable
     */
    public function index(){
        $allPosts=UserPost::with('user')->orderBy('created_at', 'DESC')->paginate(5);
        return view('home',compact('allPosts'));
    }

    public function myconfess(){
        $id = Auth::id();
        $myPosts=UserPost::with('user')->where('user_id',$id)->orderBy('created_at', 'desc')->paginate(5);
        return view('myconfess', compact('myPosts'));
    }


    public function storePosts(Request $request){
        $userPost=new UserPost();
        $userPost->posts=$request->posts;
        $userPost->user_id=$request->user_id;
        $userPost->cat_id=$request->cat_id;
        $userPost->save();
        return response()->json(['message'=>'Confess Successful']);
    }


    public function test_like(Request $request){
        $post_id=$request['post_id'];
        $post=UserPost::find($post_id);
        $is_lik=$request['is_lik'];
        $id=Auth::id();
        $user=User::find($id);
        if($is_lik=='true'){
            $isRegistered = $user->isRegisteredAsLoveReacter();
            $isRegisteredre = $post->isRegisteredAsLoveReactant();
            if ($isRegistered){
                if ($isRegisteredre){
                    $post->viaLoveReactant();
                    $reacterFacade = $user->viaLoveReacter();
                    $isReacted = $reacterFacade->hasReactedTo($post, 'Like');
                    $isReacteddislike = $reacterFacade->hasReactedTo($post, 'DisLike');
                    if($isReacted){
                        $reacterFacade->unreactTo($post, 'Like');
                    }
                    else{
                        if ($isReacteddislike){
                            $reacterFacade->unreactTo($post, 'DisLike');
                            $reacterFacade->reactTo($post, 'Like');
                        }
                        else{
                            $reacterFacade->reactTo($post, 'Like');
                        }
                    }
                }
                else{
                    $post->registerAsLoveReactant();
                }
            }
            else{
                $user->registerAsLoveReacter();
            }
        }
        if($is_lik=='false'){
            $isRegistered = $user->isRegisteredAsLoveReacter();
            $isRegisteredre = $post->isRegisteredAsLoveReactant();
            if ($isRegistered){
                if ($isRegisteredre){
                    $post->viaLoveReactant();
                    $reacterFacade = $user->viaLoveReacter();
                    $isReacted = $reacterFacade->hasReactedTo($post, 'DisLike');
                    $isReactedlike = $reacterFacade->hasReactedTo($post, 'Like');
                    if($isReacted){
                        $reacterFacade->unreactTo($post, 'DisLike');
                        return response()->json('2');
                    }
                    else{
                        if ($isReactedlike){
                            $reacterFacade->unreactTo($post, 'Like');
                            $reacterFacade->reactTo($post, 'DisLike');
                            return response()->json('1');
                        }
                        else{
                            $reacterFacade->reactTo($post, 'Dislike');
                            return response()->json('0');
                        }
                    }
                }
                else{
                    $post->registerAsLoveReactant();
                }
            }
            else{
                $user->registerAsLoveReacter();
            }
        }
        return null;
    }


    public function postSearch($id){
        $allPosts=UserPost::with('user')->orderBy('created_at', 'DESC');
        $post = UserPost::find($id);
        return view('singlepost',compact('post','allPosts'));
    }

    public function deletePost(Request $request){
        $userPost=new UserPost();
        UserPost::find($userPost->id=$request->id)->delete();
        return redirect('myconfess')->with('deletePost',"Your confess has been deleted !!");
    }
}
