@extends('component.app')


@section('content')
    <div class="container mb-5" style="margin-top:75px">
        <div class="row">
            <div class="col text-center border-bottom p-3">
                <h3>Konten Blog</h3>
                <p>Buat cerita hari ini mu dan share ke teman kamu!</p>
            </div>
        </div>
        @if ($errors->any())
            <div class="row d-flex justify-content-center mt-2">
                <div class="col-9">
                    @include('component.error', [
                        'errors' => $errors,
                    ])
                </div>
            </div>
        @endif
        @if (session('success'))
            <div class="row d-flex justify-content-center mt-2">
                <div class="col-9">
                    @include('component.alert')
                </div>
            </div>
        @endif
        <div class="row d-flex justify-content-center mt-3">
            <div class="col-9">
                <div class="row d-flex justify-content-between">
                    @if (auth()->user())
                        <div class="col-md-5 mb-1">
                            <div class="d-grid">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#BlogCreateModal"
                                    class="btn btn-dark">Create Blog Kamu</button>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-5 mb-1">
                        <div class="input-group mb-3">
                            <input type="text" name="search" class="form-control">
                            <span class="input-group-text" id="basic-addon2">Search Blog</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-1 d-flex justify-content-center">
            <div class="col-9">
                @foreach ($data as $item)
                    <div class="card p-4 m-1">
                        <div class="row">
                            @if ($item->User->image)
                                <div class="col-md-1">
                                    <img src="{{ Storage::url($item->User->image) }}" class="foto-wrapper"
                                        alt="{{ $item->User->name }}">
                                </div>
                            @else
                                <div class="col-md-1">
                                    <img src="{{asset('image/profil-default.png')}}" class="foto-wrapper"
                                        alt="{{ $item->User->name }}">
                                </div>
                            @endif
                            <div class="col-md-6">
                                <h5>{{$item->User->name}}</h5>
                                <p class="text-muted">{{$item->create_blog}}</p>
                            </div>
                        </div>
                        <div class="row">
                            @if ($item->image)
                                <div class="col">
                                    <img src="{{asset('storage/app/'.$item->image)}}" class="img-fluid"
                                        >
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p>{{$item->description}}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-1">
                                <button class="custom-btn"><i class="bi bi-heart"></i></button>
                            </div>
                            <div class="col-1">
                                <button class="custom-btn"><i class="bi bi-chat-square"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>




    <div class="modal fade" id="BlogCreateModal" tabindex="-1" aria-labelledby="BlogCreateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="BlogCreateModalLabel">Buat Blog Kamu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('blog.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="image">Upload file</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Tuliskan Blog Anda" name="description" id="description"
                                style="height: 100px"></textarea>
                            <label for="description">Comments</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Buat Blog</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
