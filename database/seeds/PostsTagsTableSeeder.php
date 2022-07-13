<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Tag;

class PostsTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i < 20; $i++){
            //estraggo random un post
            $post= Post::inRandomOrder()->first();
            $tag_id= Tag::inRandomOrder()->first()->id;
            //inserisco il dato nella tabella ponte
            //on->attach() viene inserita la relazione nella tabella ponte
            //ad attach posso passare un singolo id o un array di id
            $post->tags()->attach($tag_id);
        }
    }
}
