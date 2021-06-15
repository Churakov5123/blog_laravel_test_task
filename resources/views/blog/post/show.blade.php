@php /**  @var \App\Models\Blog\BlogPost $news */ @endphp

@extends('layouts.app')

@section('content')
        <div class="row justify-content-around">
            <div class="col-12">
                <div class="form">
                    <div class="form-group">
                        <label>Заголовок</label>
                        <input type="text" name="title" class="form-control"
                               value="{{$news->title}}">
                        <label>Категория</label>
                        <input class="form-control" name="parent_id" value="{{$news->category->title}}">
                        <label>Описание</label>
                        <input type="text" name="excerpt" class="form-control"
                               value=" {{$news->excerpt}}">
                        <label>Cтатья</label>
                        <textarea style=" height:600px;" type="text" class="form-control">
                                {{$news->content_raw}}</textarea>
                        <label>Автор</label>
                        <input type="text" name="excerpt" class="form-control"
                               value="{{$news->user->name}}">
                        <label>Дата публикации</label>
                        <input type="text" name="published_at" class="form-control"
                               value="{{$news->published_at ? $news->published_at : ''}}">
                        <label>Статус</label>
                        <input type="text" name="is_published" class="form-control"
                               value="{{$news->is_published ? 'Опубликованно':'Не опубликованно'}}">
                    </div>
                </div>
            </div>
        </div>
@endsection
