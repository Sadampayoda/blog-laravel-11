@extends('component.app')

@section('content')
    <div class="container" style="margin-top: 100px">
        <div class="row d-flex justify-content-center ms-5">
            <div class="col">
                <div class="card p-4">
                    <div class="row d-flex justify-content-center">
                        <div class="col-6 text-center p-2 border-bottom">
                            <p class="fs-3 mb-2">Blog</p>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-6 text-center p-2 border-bottom">
                            @if ($errors->any())
                                @include('component.error',[
                                    'errors' => $errors
                                ])
                            @endif
                            @include('component.alert')
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center mt-3">
                        <div class="col-6">
                            <form action="{{route('register.validate')}}" method="post">
                                @csrf
                                <div class="mb-2">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control">
                                    @error('email')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                    @error('name')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                    @error('password')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="confirmed">Confirmed Password</label>
                                    <input type="password" name="confirmed" id="confirmed" class="form-control">
                                    @error('confirmed')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-dark">Buat Aplikasi</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
