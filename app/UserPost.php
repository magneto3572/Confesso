<?php


namespace App;
use Cog\Contracts\Love\Reactable\Models\Reactable as ReactableContract;
use Cog\Contracts\Love\ReactionType\Models\ReactionType;
use Cog\Laravel\Love\Reactable\Models\Traits\Reactable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserPost extends Model implements  ReactableContract
{
    use SoftDeletes;
    use Reactable;
    protected $dates=['deleted_at'];

    protected $fillable=['posts','user_id', 'cat_id'];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function postcategory()
    {
        return $this->hasOne(user_category::class);

    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function countlikes($id)
    {
        $reaction = DB::table('love_reactions')
            ->where('reactant_id', $id)
            ->where('reaction_type_id',1)
            ->count();
        return $reaction;
    }
    public function countdislikes($id)
    {
        $reaction = DB::table('love_reactions')
            ->where('reactant_id', $id)
            ->where('reaction_type_id',2)
            ->count();
        return $reaction;
    }

    public function checklikes($id){
        $user= Auth::id();
        $like=DB::table('love_reactions')
            ->where('reacter_id',$user)
            ->where('reactant_id',$id)
            ->where('reaction_type_id',1)
            ->count();
        return $like;
    }
    public function checkdislikes($id){
        $user= Auth::id();
        $dislike=DB::table('love_reactions')
            ->where('reacter_id',$user)
            ->where('reactant_id',$id)
            ->where('reaction_type_id',2)
            ->count();
        return $dislike;
    }
}
