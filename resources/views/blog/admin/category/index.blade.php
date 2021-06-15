@php
    use Illuminate\Database\Eloquent\Collection;

/**  @var Collection $categories */
@endphp

@extends('layouts.app')

@section('content')
    @include('blog.include.headerAdmin')
    <div class="row">
        @include('blog.include.errors')
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Родительская категория</th>
                    <th scope="col">Слаг</th>
                    <th scope="col">Заголовок</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Просмотр</th>
                    <th scope="col">Редактирование</th>
                    <th scope="col">Удалить</th>
                </tr>
                </thead>
                @foreach($categories as $category)
                    <tbody>
                    <tr>
                        <td>{{$category->parent_id}}</td>
                        <td>{{$category->slug}}</td>
                        <td>{{$category->title}}</td>
                        <td>{{$category->description}}</td>
                        <td><a href="/blog/admin/category/{{$category->id}}" target="_blank">&#128065;</a></td>
                        <td><a href="/blog/admin/category/{{$category->id}}/edit" target="_blank">&#128395;</a></td>
                        <td>
                            <form action="{{ route('blog.admin.category.destroy', $category->id)}}" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-outline-danger" type="submit">Удалить</button>
                            </form>
                        </td>
                    </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
    </div>
@endsection
