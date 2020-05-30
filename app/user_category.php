<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class user_category extends Model
{
    protected $table = 'user_category';

    public function userpost()
    {
        return $this->hasMany(UserPost::class);
    }

    public static function post_count()
    {
        $total =DB::table('user_posts')
            ->select(DB::raw('count(posts) as total, cat_name'))
            ->leftJoin('user_category', 'user_category.id', '=', 'user_posts.cat_id')
            ->groupBy('cat_id')
            ->get();

        return $total;
    }
}
