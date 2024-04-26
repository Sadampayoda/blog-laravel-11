@extends('component.app')


@section('content')
{{-- @dd($data[1]->Love) --}}
    <div class="container mb-5" style="margin-top:75px">
        <div class="row">
            <div class="col text-center border-bottom p-3">
                <h3>Notifkasi Kamu</h3>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-7">
                @foreach ($data as $item)
                    @if ($item->Love)
                        @foreach ($item->Love as $love )
                            <div class="card border rounded shadow p-3">
                                <div class="row">
                                    @if ($love->User->image)
                                        <div class="col-md-1">
                                            <img src="{{ asset('image/profile/' . $love->User->image) }}"
                                                class="foto-wrapper" alt="{{ $love->User->name }}">
                                        </div>
                                    @else
                                        <div class="col-md-2">
                                            <img src="{{ asset('image/profil-default.png') }}" class="foto-wrapper">
                                        </div>
                                    @endif
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col">
                                                <h5>{{ $love->User->name }}<h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p>Blog anda disukai oleh {{ $love->User->name }}</p>
                                            </div>
                                            <div class="col-md-4 d-flex align-items-end">
                                                <p><a class="text-center" href="{{ route('blog.show', $love->Blog->id) }}">Lihat
                                                        Blog</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
