@extends('layouts.app')
@section('content')
    <style>
        .custom {
            border-radius: 20px;
            overflow: hidden;
        }

        .but {
            color: #000000;
        }
    </style>
    @include('layouts.nav_layout')
    <br>
    <div class="card gedf-card custom">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mr-2">
                        <img class="rounded-circle" width="45"
                             src="{{asset('img/user-picture.png')}}"
                             alt="profile">
                    </div>

                    <div class="ml-2">
                        <div class="h-8 m-0">{{$post->user->name}}</div>
                    </div>
                    @php
                        if(!empty($post)){$category=\App\user_category::find($post->cat_id);}
                    @endphp
                    <div class="ml-2">
                                        <span class="badge badge-success h-8 m-0">  <i
                                                class="fa fa-tags"></i> <strong>{{ $category->cat_name}}</strong> </span>
                    </div>
                </div>
                <div>
                    <div class="dropdown">
                        <button class="btn btn-link" type="button" id="gedf-drop1"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                            <div class="h6 dropdown-header">Configuration</div>
                            <a class="dropdown-item" href="#">Save</a>
                            <a class="dropdown-item" href="#">Hide</a>
                            <a class="dropdown-item" href="#">Report</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="text-muted h7 mb-2"><i
                    class="fa fa-clock-o"></i>{{ \Carbon\Carbon::parse($post['created_at'])->diffForHumans()}}
            </div>
            <a class="card-link" href="#">
                <h5></h5>
            </a>
            <p>{{$post->posts}}</p>

        </div>
        @auth
            <div class="card-footer bg-transparent">
                @php
                    $Comments=\App\Comment::where('commentable_id',$post->id)->get()->count();
                @endphp
                <div id="reload">
                    @if($post->checklikes($post->id)==1)
                        <a class="card-link lik" id="likere" role="button" data-id="{{$post->id}}">
                            <i class="fas fa-thumbs-up" style="color: green"></i>{{$post->countlikes($post->id)}}</a>
                    @else
                        <a class="card-link lik" id="likere" role="button" data-id="{{$post->id}}">
                            <i class="fas fa-thumbs-up"></i>{{$post->countlikes($post->id)}}</a>
                    @endif
                    @if($post->checkdislikes($post->id)==1)
                        <a class="card-link lik" id="disre" role="button" data-id="{{$post->id}}">
                            <i class="fas fa-thumbs-down"
                               style="color: green"></i>{{$post->countdislikes($post->id)}}</a>
                    @else
                        <a class="card-link lik" id="disre" role="button" data-id="{{$post->id}}">
                            <i class="fas fa-thumbs-down"></i>{{$post->countdislikes($post->id)}}</a>
                    @endif
                    <a class="card-link but" href="/post/{{$post->id}}" role="button">
                        <i class="fas fa-comment"></i>{{$Comments}}</a>
                </div>
                <div class="form-row text-center">
                    <div class="col-10">
                        <div class="form-group" id="inpu-re">
                            <input type="text" placeholder="Write a Comment" name="comment_body" id="cominu"
                                   class="form-control com_cust"/>
                            <input type="hidden" id='inu' name="post_id" value="{{ $post->id}}"/>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <button type="submit" id="comm" class="btn btn-primary btn-circle rep"><i
                                    class=" fa fa-send"></i></button>
                        </div>
                    </div>
                </div>
                <div id="comre">
                    @include('partials._comment_replies', ['comments' => $post->comments, 'post_id' => $post->id])
                </div>
            </div>
        @endauth
    </div>
@endsection
<script>
    const token = '{{\Illuminate\Support\Facades\Session::token()}}';
</script>




