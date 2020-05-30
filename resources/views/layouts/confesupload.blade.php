<div class="card gedf-card cut">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab"
                   aria-controls="posts" aria-selected="true">Make a Confession</a>
            </li>
        </ul>
    </div>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
@endif

<!-- layout for post upload option -->
    <div class="card-body">
        <form id="cform">
            {{csrf_field()}}

            <fieldset>
                <div class="form-group">
                    <textarea name="posts" id="posts" cols="10" rows="5" class="form-control"></textarea>
                    <input type="hidden" value="{{\Illuminate\Support\Facades\Auth::id()}}" name="user_id"
                           id="user_id">
                </div>
                @php
                    $categories=\App\user_category::all();
                @endphp
                <div class="form-group pull-left">
                    <select class="btn btn-primary dropdown-toggle" name="category" id="category">
                        <option value="#">User Type</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group btn-primary">
                    <a class="btn btn-primary pull-right" id="addPost">Submit</a>
                </div>
            </fieldset>
        </form>
        <span class="label label-success postConfirm" style="font-size: 15px"></span>
        <span class="label label-danger validation" style="font-size: 15px"></span>
    </div>
</div>
