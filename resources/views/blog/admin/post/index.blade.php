@php
    /**  @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $news */
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
                    <th scope="col">Автор</th>
                    <th scope="col">Категория</th>
                    <th scope="col">Заголовок</th>
                    <th scope="col">Краткое описание</th>
                    <th scope="col">Дата</th>
                    <th scope="col">Просмотр</th>
                    <th scope="col">Редактирование</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Удалить</th>
                </tr>
                </thead>
                @foreach($allNews as $news)
                    <tbody>
                    <tr>
                        <td>{{$news->user->name}}</td>
                        <td>{{$news->category->title}}</td>
                        <td>{{$news->title}}</td>
                        <td>{{$news->excerpt}}</td>
                        <td>{{$news->published_at}}</td>
                        <td><a href="/blog/admin/posts/{{$news->id}}" target="_blank">&#128065;</a></td>
                        <td><a href="/blog/admin/posts/{{$news->id}}/edit" target="_blank">&#128395;</a></td>
                        <td>{{$news->is_published?'Опубликованно':'Черновик'}}</td>
                        <td>
                            <form action="{{ route('blog.admin.posts.destroy', $news->id)}}" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-outline-danger" type="submit">Удалить</button>
                            </form>
                        </td>
                    </tr>
                    </tbody>
                @endforeach
            </table>
            <div class="row justify-content-md-center">
                <nav aria-label="test">
                    <ul class="pagination pagination-sm justify-content-center">
                        <li class="page-item">{{$allNews->links()}}</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
