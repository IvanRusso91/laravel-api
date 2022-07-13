<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;

use App\Http\Requests\PostRequest;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::all();
        $posts=Post::orderBy('id','desc')->paginate(5);
        return view('admin.posts.index', compact('posts','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories= Category::all();
        $tags=Tag::all();
        return view('admin.posts.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $data= $request->all();
        $new_post = new Post();
        $data['slug']= Post::generateSlug($data['title'], '-');
        $new_post->fill($data);
        $new_post->save();

        //per aggiungere i tag nella tabella ponte prima devo avere fatto il save del post
        // Prima di effettuare l'attach devo verificare se esiste l'array tags dentro $data.

        if(array_key_exists('tags', $data)){
            $new_post->tags()->attach($data['tags']);
        }


        return redirect()->route('admin.posts.show', $new_post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts= Post::find($id);
        if($posts){
            return view('admin.posts.show', compact('posts'));
        }
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories= Category::all();
        $tags=Tag::all();
        $posts= Post::find($id);
        if($posts){
            return view('admin.posts.edit', compact('posts','categories', 'tags'));
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $data=$request->all();
        if($data['title'] != $post->title){

            $data['slug']= Post::generateSlug($data['title'],'-');
        }else{
            $post->tags()->detach();
        }

        $post->update($data);

        if(array_key_exists('tags', $data)){
            //se esiste l'array tags lo uso per sincronizare i dati della tabella ponte
            $post->tags()->sync($data['tags']);
        }else{
            //se non esiste, devo cancellare tutte le relazioni presenti
            $post->tags()->detach();

        }

        return redirect()->route('admin.posts.show',$post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('post_cancellato', "il post $post->title è stato eliminato correttamente!");
    }
}
