@php

    use App\Models\Blog\BlogPost;
    use App\Presenters\Blog\Post\PostEditPresenter;
    use App\Presenters\Blog\Post\AuxiliaryData;
    use Illuminate\Database\Eloquent\Collection;

    /**  @var PostEditPresenter $freshNews */

    /**  @var BlogPost $news */
    $news = $freshNews->getNews();
    /** @var AuxiliaryData  $auxiliaryData */
    $auxiliaryData = $freshNews->getAuxiliaryData();
    /** @var  Collection $categories */
    $categories = $auxiliaryData->getCategories();
    /** @var  Collection $users */
    $users = $auxiliaryData->getUsers();
@endphp

@extends('layouts.app')

@section('content')
    @include('blog.include.headerAdmin')

    <form method="POST" action="{{route('blog.admin.posts.store')}}">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="form">

                    @include('blog.include.errors')

                    <div class="form-group">
                        <label>Заголовок</label>
                        <input type="text" name="title" class="form-control"
                               value="{{$news->title}}">
                        <label>Категория</label>
                        <select class="form-control" name="category_id" required>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}"
                                        @if($category->id===$news->category_id) selected @endif>{{$category->title}}</option>
                            @endforeach
                        </select>
                        <label>Слаг</label>
                        <input type="text" name="slug" class="form-control"
                               value=" {{$news->slug}}">
                        <label>Описание</label>
                        <input type="text" name="excerpt" class="form-control"
                               value=" {{$news->excerpt}}">
                        <label>Cтатья</label>
                        <textarea style="height:500px;" type="text" name="content_raw" class="form-control">
                                {{old('content_raw', $news->content_raw)}}</textarea>
                        <label>Автор</label>
                        <select name="user_id" class="form-control" required>
                            @foreach($users as $user)
                                <option value="{{$user->id}}"
                                        @if($user->id===$news->user_id) selected @endif>{{$user->name}}</option>
                            @endforeach
                        </select>
                        <label>Дата публикации</label>
                        <input type="text" name="published_at" class="form-control"
                               value="{{$news->published_at}}">
                        <label>Статус</label>
                        <input type="hidden" name="is_published" value="0"/>
                        <input type="checkbox" name="is_published" value="1" checked/>
                        <label for="scales">Опубликованно</label>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Создать</button>
            </div>
        </div>
    </form>
@endsection
