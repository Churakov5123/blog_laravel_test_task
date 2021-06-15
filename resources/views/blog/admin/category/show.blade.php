@php
    use App\Models\Blog\BlogCategory;

   /**  @var BlogCategory $category */
@endphp
@extends('layouts.app')

@section('content')
    @include('blog.include.headerAdmin')

    @include('blog.include.errors')
    <div class="row justify-content-around">
        <div class="col-12">
            <div class="form">
                <div class="form-group">
                    <label>Родительская категория</label>
                    <input type="text" name="title" class="form-control"
                           value="{{$category->parent_id}}">
                    <label>Слаг</label>
                    <input class="form-control" name="parent_id" value="{{$category->slug}}">
                    <label>Заголовок</label>
                    <input type="text" name="excerpt" class="form-control"
                           value=" {{$category->title}}">
                    <label>Описание</label>
                    <textarea style=" height:600px;" type="text" class="form-control">
                                {{$category->description}}</textarea>
                </div>
            </div>
        </div>
    </div>
@endsection
