@php

    use App\Models\Blog\BlogCategory;
    use App\Presenters\Blog\Category\CategoryEditPresenter;
    use Illuminate\Database\Eloquent\Collection;

    /**  @var CategoryEditPresenter $freshCategory */

     /** @var Collection $categories */
    $categories=$freshCategory->getCategories();
    /** @var BlogCategory $category */
    $category=$freshCategory->getCategory();
@endphp
@extends('layouts.app')

@section('content')
    @include('blog.include.headerAdmin')

    @include('blog.include.errors')
    <form method="POST" action="{{route('blog.admin.category.store')}}">
        @csrf
        <div class="row justify-content-around">
            <div class="col-12">
                <div class="form">
                    <div class="form-group">
                        <label>Родительская категория</label>
                        <select class="form-control" name="parent_id" required>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                        </select>
                        <label>Слаг</label>
                        <input class="form-control" name="slug" value="{{$category->slug}}">
                        <label>Заголовок</label>
                        <input type="text" name="title" class="form-control"
                               value=" {{$category->title}}">
                        <label>Описание</label>
                        <textarea style=" height:600px;"  name="description" type="text" class="form-control mb-4">
                                {{$category->description}}</textarea>
                        <button class="btn btn-primary " type="submit">Создать</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
