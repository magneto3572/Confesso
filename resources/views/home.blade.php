@extends('layouts.app')
<style>
    .custom {
        border-radius: 20px;
        overflow: hidden;
    }

    .but {
        color: #000000;
    }
</style>
@section('content')
    @include('layouts.nav_layout')
    <!-- layout for post upload form /////-->
    @include('layouts.confesupload')
    <br>
    <!-- end of Post upload /////-->
    <div class="infinite-scroll">
        @foreach($allPosts as $posts)
            <div id="postsTable">
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
                                    <div class="h-8 m-0">{{$posts->user->name}}</div>
                                </div>
                                @php
                                    if(!empty($posts)){$category=\App\user_category::find($posts->cat_id);}
                                @endphp
                                <div class="ml-2">
                                        <span class="badge badge-success h-8 m-0">  <i
                                                class="fa fa-tags"></i> <strong>{{ $category->cat_name}}</strong> </span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="text-muted h7 mb-2"><i
                                class="fa fa-clock-o"></i>{{ \Carbon\Carbon::parse($posts['created_at'])->diffForHumans()}}
                        </div>
                        <a class="card-link" href="#">
                            <h5></h5>
                        </a>
                        <p>{{$posts->posts}}</p>

                    </div>
                    @auth
                        <div class="card-footer bg-transparent">
                            @php
                                if(!empty($posts)){$Comments=\App\Comment::where('commentable_id',$posts->id)->get()->count();}
                            @endphp
                            <div id="reload">
                                @if($posts->checklikes($posts->id)==1)
                                    <a class="card-link lik" id="likere" role="button" data-id="{{$posts->id}}">
                                        <i class="fas fa-thumbs-up sign"
                                           style="color: green"></i><span>{{$posts->countlikes($posts->id)}}</span></a>
                                @else
                                    <a class="card-link lik" id="likere" role="button" data-id="{{$posts->id}}">
                                        <i class="fas fa-thumbs-up"></i><span>{{$posts->countlikes($posts->id)}}</span></a>
                                @endif
                                @if($posts->checkdislikes($posts->id)==1)
                                    <a class="card-link lik" id="disre" role="button" data-id="{{$posts->id}}">
                                        <i class="fas fa-thumbs-down"
                                           style="color: green"></i><span>{{$posts->countdislikes($posts->id)}}</span></a>
                                @else
                                    <a class="card-link lik" id="disre" role="button" data-id="{{$posts->id}}">
                                        <i class="fas fa-thumbs-down"></i><span>{{$posts->countdislikes($posts->id)}}</span></a>
                                @endif
                                <a class="card-link but" href="/post/{{$posts->id}}" role="button">
                                    <i class="fas fa-comment"></i><span>{{$Comments}}</span></a>
                            </div>
                        </div>
                    @endauth
                </div>
                <br>
            </div>
            <br>
        @endforeach
        {{ $allPosts->links() }}
    </div>
    <!-- Post /////-->
    </div>
@endsection
