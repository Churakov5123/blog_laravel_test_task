@php /**  @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $news */ @endphp

@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Автор</th>
                    <th scope="col">Категория</th>
                    <th scope="col">Заголовок</th>
                    <th scope="col">Краткое описание</th>
                    <th scope="col">Дата</th>
                    <th scope="col">Просмотр</th>
                </tr>
                </thead>
                @foreach($allNews as $item)
                    @if(!$item->is_published)
                        @continue
                    @endif
                    <tbody>
                    <tr>
                        <td>{{$item->user->name}}</td>
                        <td>{{$item->category->title}}</td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->excerpt}}</td>
                        <td>{{$item->published_at}}</td>
                        <td><a href="/posts/{{$item->id}}" target="_blank">&#128065;</a></td>
                    </tr>
                    </tbody>
                @endforeach
            </table>
            <div class="row justify-content-md-center">
                <div class="col">
                    <nav aria-label="test">
                        <ul class="pagination pagination-sm justify-content-center">
                            <li class="page-item">{{ $allNews->links()}}</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
