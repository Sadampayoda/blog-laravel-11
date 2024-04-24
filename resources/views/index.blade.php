@extends('component.app')


@section('content')
    <div class="container mb-5" style="margin-top:75px">
        <div class="row">
            <div class="col text-center border-bottom p-3">
                <h3>Konten Blog</h3>
                <p>Buat cerita hari ini mu dan share ke teman kamu!</p>
            </div>
        </div>
        <div class="row d-flex justify-content-center mt-3">
            <div class="col-9">
                <div class="row d-flex justify-content-between">
                    @if (auth()->user())
                        <div class="col-md-5 mb-1">
                            <div class="d-grid">
                                <button class="btn btn-dark">Create Blog Kamu</button>
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
                <div class="card p-4">
                    <div class="row">
                        <div class="col-md-1">
                            <img src="{{ asset('image/RobloxScreenShot20240423_224107934.png') }}" class="foto-wrapper"
                                 alt="">
                        </div>
                        <div class="col-md-6">
                            <h5>Sadam Payoda</h5>
                            <p class="text-muted">09:00 - 19 November 2024</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <img src="{{asset('image/RobloxScreenShot20240423_224107934.png')}}" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Libero ut ea ab quam perspiciatis
                                quod placeat fugit cum eum. Adipisci consequuntur accusamus, sunt harum quidem sit. Totam
                                quaerat atque error.</p>
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
            </div>
        </div>
    </div>
@endsection
