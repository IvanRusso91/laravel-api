<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // per ottenere la relazione $tags->post.

    public function posts(){
        return $this->belongsToMany('App\Post');
    }

}
