<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     //per ottenere  $post->category laravel esegue la join restituendo  la relazione come proprietà
    //per fare questo crea un metodo pubblico col nome della relazione

    public function posts(){
        return $this->hasMany('App\Post');
    }
}
