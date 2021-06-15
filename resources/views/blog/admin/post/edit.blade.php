@php

    use App\Models\Blog\BlogPost;
    use App\Presenters\Blog\Post\PostEditPresenter;
    use App\Presenters\Blog\Post\AuxiliaryData;
    use Illuminate\Database\Eloquent\Collection;

    /**  @var PostEditPresenter $dataForEdit */
    /**  @var BlogPost $news */
    $news = $dataForEdit->getNews();
    /** @var AuxiliaryData  $auxiliaryData */
    $auxiliaryData = $dataForEdit->getAuxiliaryData();
    /** @var  Collection $categories */
    $categories = $auxiliaryData->getCategories();
    /** @var  Collection $users */
    $users = $auxiliaryData->getUsers();
@endphp

@extends('layouts.app')

@section('content')

    @include('blog.include.headerAdmin')

    <form method="POST" action="{{route('blog.admin.posts.update', $news->id)}}">
        @method('PATCH')
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
                        <label>Описание</label>
                        <input type="text" name="excerpt" class="form-control"
                               value=" {{$news->excerpt}}">
                        <label>Cтатья</label>
                        <textarea style="height:500px;" type="text" name="content_raw" class="form-control">
                                {{old('content_raw', $news->content_raw)}}</textarea>
                        <label>Автор</label>
                        <select name="user_id" class="form-control" placeholder="строка" required>

                            @foreach($users as $user)
                                <option value="{{$user->id}}"
                                        @if($user->id===$news->user_id) selected @endif>{{$user->name}}</option>
                            @endforeach

                        </select>
                        <label>Дата публикации</label>
                        <input type="text" name="published_at" class="form-control"
                               value="{{$news->published_at? $news->published_at : ''}}">
                        <label>Статус</label>
                        <input type="checkbox" name="is_published" value="{{$news->is_published}}"
                               @if($news->is_published===1)checked @endif>
                        <label for="scales">Опубликованно</label>
                    </div>
                </div>
                <label>Создано</label>
                <input type="text" name="created_at" class="form-control"
                       value="{{$news->created_at}}">
                <label>Изменено</label>
                <input type="text" name="updated_at" class="form-control"
                       value="{{$news->updated_at}}">
                <label>Удалено</label>
                <input type="text" name="deleted_at" class="form-control mb-4"
                       value="{{$news->deleted_at}}">
                <button class="btn btn-primary" type="submit">Изменить</button>
            </div>
        </div>
    </form>
@endsection
