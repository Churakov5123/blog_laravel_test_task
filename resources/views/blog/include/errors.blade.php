@if($errors->any())
    <div class="alert alert-danger col-12" role="alert">
        {{$errors->first()}}
    </div>
@endif()

@if(session('success'))
    <div class="alert alert-success col-12" role="alert">
        {{session('success')}}
    </div>
@endif
