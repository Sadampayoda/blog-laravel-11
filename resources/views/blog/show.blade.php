@extends('component.app')


@section('content')
    <div class="container mb-5" style="margin-top:75px">
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
        <div class="row mt-1 d-flex justify-content-center">
            <div class="col-md-7" id="blog">
                <div class="card p-4 m-1">
                    <div class="row">
                        @if ($data->User->image)
                            <div class="col-md-2">
                                <img src="{{ asset('image/profile/' . $data->User->image) }}" class="foto-wrapper"
                                    alt="{{ $data->User->name }}">
                            </div>
                        @else
                            <div class="col-md-2">
                                <img src="{{ asset('image/profil-default.png') }}" class="foto-wrapper"
                                    alt="{{ $data->User->name }}">
                            </div>
                        @endif
                        <div class="col-md-6">
                            <h5>{{ $data->User->name }}</h5>
                            <p class="text-muted">{{ $data->create_blog }}</p>
                        </div>
                    </div>
                    <div class="row">
                        @if ($data->image)
                            <div class="col">
                                <img src="{{ asset('image/blogs/' . $data->image) }}" class="img-fluid">
                            </div>
                        @endif
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <p>{{ $data->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card p-2">
                    <div class="row">
                        <div class="col text-center p-1">
                            <p class="text-muted">Lihat Komentar</p>
                        </div>
                    </div>
                    <div class="row m-1">
                        <div class="col-12  border rounded form-comment overflow-y-scroll" id="form-comment">
                            @foreach ($data->Comment as $item)
                                <div class="row border rounded bg-light p-2 m-2">
                                    @if ($item->User->id == auth()->user()->id)
                                        <div class="row mb-1 ">
                                            <div class="col text-danger">
                                                <i class="bi bi-person-bounding-box"></i> {{ $item->User->name }}
                                            </div>
                                            <div class="col text-end">
                                                <button class="custom-btn" type="button" id="delete-comment"
                                                    data-id="{{ $item->id }}">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row mb-1">
                                            <div class="col text-muted">
                                                <i class="bi bi-person-bounding-box"></i> {{ $item->User->name }}
                                            </div>
                                            @if ($item->User->id == auth()->user()->id)
                                                <div class="col text-end">
                                                    <button class="custom-btn" type="button" id="delete-comment"
                                                        data-id="{{ $item->id }}">
                                                        <i class="bi bi-trash3"></i>
                                                    </button>
                                                </div>

                                            @endif
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col">
                                            {{ $item->comment }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row m-1">
                        <div class="col p-2 border">
                            <div class="input-group">
                                <input type="text" class="form-control border-dark" name="comment" id="input-comment">
                                <input type="hidden" name="id_blog" id="id-blog" value="{{ $data->id }}">
                                <button class="btn btn-outline-dark" type="button" id="button-comment">Button</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







    <script>
        $(document).ready(function() {
            $('#button-comment').click(function() {
                var comment = $('#input-comment').val();
                var blog_id = $('#id-blog').val();
                if (comment) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('commend.store') }}",
                        data: {
                            comment: comment,
                            _token: '{{ csrf_token() }}',
                            blog_id: blog_id
                        },
                        success: function(respons) {
                            console.log('Success')
                            loadComments(blog_id)
                        }
                    })
                }
            })

            $('#delete-comment').click(function() {
                var comment_id = $(this).data('id')
                var blog_id = $('#id-blog').val();

                $.ajax({
                    type: 'DELETE',
                    url: "{{ route('commend.destroy', ['commend' => '__commend_id__']) }}".replace('__commend_id__', comment_id),
                    data: {
                        _token: '{{ csrf_token() }}',
                        comment_id:comment_id
                    },
                    success: function(respons) {
                        console.log(respons)
                        loadComments(blog_id)
                    }
                })

            })

            function loadComments(blog_id) {
                $.ajax({
                    type: 'GET',
                    url: '/blog/comment/' + blog_id,
                    success: function(response) {
                        $('#form-comment').html(response);
                    }
                });
            }

        })
    </script>
@endsection
