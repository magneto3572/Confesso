<style>
    .tex {
        font-size: small;
    }

    .tex2 {
        border-radius: 20px;
        overflow: hidden;
        margin-left: auto;
    }

    .cust {
       padding-left: 20px;
    }

    .bo{
        border: hidden;
        border-bottom-style: dashed;
        border-bottom-color: #00C4CF;
    }

</style>

@foreach($comments as $comment)
    <div class="display-comment">
        <div class="row tex2">
            <div class="container bg-light">
                <div class="col-7">
                    <strong>{{ $comment->user->name }}</strong>
                    <p style="margin: 0">{{ $comment->body }}</p>
                </div>
                <form method="post" action="{{ route('reply.add') }}" class="row">
                    @csrf
                    <div class="form-group col-10">
                        <input type= "text"  name="comment_body" placeholder="Reply to this comment" class="tex form-control bo bg-light"/>
                        <input type="hidden" name="post_id" value="{{ $post_id }}" />
                        <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                    </div>
                    <div class="form-group col-auto">
                        <button type="submit" class="btn btn-primary btn-circle rep"><i class="fa fa-send"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="cust">
            <a class="tex cust "><i class="fa fa-clock-o"></i>{{ \Carbon\Carbon::parse($comment['created_at'])->diffForHumans()}}</a>
        </div>
        <br>
        <div class="container-md cust">
            @include('partials._comment_replies', ['comments' => $comment->replies])
        </div>
    </div>
@endforeach

