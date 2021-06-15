@extends('layouts.app')

@section('content')
    @include('blog.include.headerAdmin')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Панель управления</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <p>Добро пожаловать {{auth()->user()->name}} </p>
                        <p>Вам доступны функции добавления/редактирование/удаления статей и категорий.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
