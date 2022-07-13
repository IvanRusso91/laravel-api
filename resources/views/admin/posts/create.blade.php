@extends('layouts.app')

@section('content')
<div class="container my-5">

    <div class="row">
        @if ($errors->any())
            <div class="col-8 offset-2 alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error )
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-8 offset-2">
            <h2 class="mb-3">Inserisci un nuovo Post</h2>
            <form action="{{ route('admin.posts.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Post Title</label>
                    <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Post Title" value="{{ old('title')}}">

                    @error('title')
                        <p class="text-danger">
                            {{$message}}
                        </p>
                    @enderror

                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">description</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" cols="30" rows="10" >{{ old('content')}}</textarea>

                    @error('content')
                        <p class="text-danger">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                <div class="mb-3">
                    <select class="form-select" name="category_id">
                        <option value="">Seleziona una categoria</option>
                        @foreach ($categories as $category)
                        <option @if ($category->id == old('category_id')) selected

                        @endif value="{{$category->id}}">{{$category->name}}</option>

                        @endforeach
                    </select>
                </div>
                <div class="mb-3">


                    @foreach ($tags as $tag)
                        <input type="checkbox" name="tags[]" id="tag{{$loop->iteration}}"
                        value="{{$tag->id}}"
                        @if(in_array($tag->id, old('tags', [])) ) checked @endif>
                        <label class="mr-3" for="tag{{$loop->iteration}}">{{$tag->name}}</label>
                    @endforeach

                </div>

                <button type="submit" class="btn btn-primary">Invia</button>

            </form>
        </div>
    </div>

</div>
@endsection
