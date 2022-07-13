<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use illuminate\Support\Str;

class Post extends Model
{

    //per ottenere  $post->category laravel esegue la join restituendo  la relazione come proprietà
    //per fare questo crea un metodo pubblico col nome della relazione

    public function category(){
        return $this->belongsTo('App\Category');
    }

    //creo la relazione many to many con i tags per ottenere $post->tags.

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }



    protected $fillable =[
        'title',
        'slug',
        'content',
        'category_id',
    ];


    public static function generateSlug($title){

        $slug = Str::slug($title, '-');
        $slug_base= $slug;

        $post_slug= Post::where('slug', $slug)->first();
        $c=1;

        while($post_slug){
            $slug = $slug_base .'-'. $c;
            $c++;
            $post_presente= Post::where('slug', $slug)->first();
        }
        return $slug;
    }
}
