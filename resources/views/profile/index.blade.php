@extends('component.app')


@section('content')
    <div class="container mb-5" style="margin-top:75px">
        <div class="row d-flex justify-content-center">
            <div class="col-9 text-center border-bottom p-3">
                @if ($errors->any())
                    <div class="row d-flex justify-content-center mt-2">
                        <div class="col">
                            @include('component.error', [
                                'errors' => $errors,
                            ])
                        </div>
                    </div>
                @endif
                @if (session('success'))
                    <div class="row d-flex justify-content-center mt-2">
                        <div class="col">
                            @include('component.alert')
                        </div>
                    </div>
                @endif
                <div class="row d-flex align-content-center">
                    @if (auth()->user()->image)
                        <div class="col-3">
                            <img src="{{ asset('image/profile/' . auth()->user()->image) }}" class="foto-wrapper"
                                alt="{{ auth()->user()->name }}">
                        </div>
                    @else
                        <div class="col-3">
                            <img src="{{ asset('image/profil-default.png') }}" class="foto-wrapper"
                                alt="{{ auth()->user()->name }}">
                        </div>
                    @endif
                    <div class="col-3 mt-2">
                        <h3>{{ auth()->user()->name }}</h3>
                    </div>

                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-9">
                <div class="row d-flex justify-content-center mt-2 border-bottom p-2">
                    <div class="col-2">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#ProfileEdit"
                            class="btn btn-dark">Edit Profile</button>
                    </div>
                    <div class="col-2">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#ProfileEditPassword"
                            class="btn btn-dark">Password</button>
                    </div>
                </div>
                <div class="row d-flex justify-content-center mt-4">
                    <div class="col-7 p-3">

                        <h2 class="text-center">Blog Saya</h2>

                    </div>
                </div>
                <div class="row mt-2 d-flex justify-content-center">
                    <div class="col-10" id="content">
                        @foreach ($data as $item)
                            {{-- @dd($item->image) --}}
                            <div class="card p-4 m-1">
                                <div class="row">
                                    @if ($item->User->image)
                                        <div class="col-md-2">
                                            <img src="{{ asset('image/profile/' . $item->User->image) }}"
                                                class="foto-wrapper" alt="{{ $item->User->name }}">
                                        </div>
                                    @else
                                        <div class="col-md-2">
                                            <img src="{{ asset('image/profil-default.png') }}" class="foto-wrapper"
                                                alt="{{ $item->User->name }}">
                                        </div>
                                    @endif
                                    <div class="col-md-6">
                                        <h5>{{ $item->User->name }}</h5>
                                        <p class="text-muted">{{ $item->create_blog }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    @if ($item->image)
                                        <div class="col">
                                            <img src="{{ asset('image/blogs/' . $item->image) }}" class="img-fluid">
                                        </div>
                                    @endif
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <p>{{ $item->description }}</p>
                                    </div>
                                </div>
                                {{-- @dd($item->love[0]->user_id) --}}
                                <div class="row">
                                    @if (auth()->user())
                                        @if ($item->loves)
                                            <div class="col-2">
                                                <button class="custom-btn love" data-id="{{ $item->id }}"><i
                                                        id="icon{{ $item->id }}" class="bi bi-heart-fill text-danger"
                                                        id="count-icon{{ $item->id }}"></i> <span
                                                        id="count-icon{{ $item->id }}">{{ $item->countLove }}</span>
                                                </button>
                                                <input type="hidden" name="status" id="status{{ $item->id }}"
                                                    value="on">
                                                <input type="hidden" name="id_love" id="id_love{{ $item->id }}"
                                                    value="{{ $item->id_love }}">
                                                <input type="hidden" name="count" id="count{{ $item->id }}"
                                                    value="{{ $item->countLove }}">
                                            </div>
                                        @else
                                            <div class="col-2">
                                                <button class="custom-btn love" data-id="{{ $item->id }}"><i
                                                        id="icon{{ $item->id }}" class="bi bi-heart"></i> <span
                                                        id="count-icon{{ $item->id }}">{{ $item->countLove }}</span></button>
                                                <input type="hidden" name="status" id="status{{ $item->id }}"
                                                    value="off">
                                                <input type="hidden" name="count" id="count{{ $item->id }}"
                                                    value="{{ $item->countLove }}">

                                            </div>
                                        @endif
                                    @else
                                        <div class="col-1">
                                            <a href="{{ route('login') }}" class="custom-btn love"><i
                                                    class="bi bi-heart"></i> <span>{{ $item->countLove }}</span></a>
                                        </div>
                                    @endif

                                    <div class="col-1 ">
                                        <a href="{{ route('blog.show', $item->id) }}"
                                            class="custom-btn mt-1 text-decoration-none text-dark"><i
                                                class="bi bi-chat-square"></i>
                                        </a>
                                    </div>
                                    @if (auth()->user()->id == $item->User->id)
                                        <div class="col-1">
                                            <button type="button" class="custom-btn" data-bs-toggle="modal"
                                                data-bs-target="#BlogEditModal{{ $item->id }}"><i
                                                    class="bi bi-pencil-square"></i></i>
                                            </button>

                                        </div>
                                        <div class="col-1">
                                            <button type="button" class="custom-btn" data-bs-toggle="modal"
                                                data-bs-target="#BlogDeleteModal{{ $item->id }}"><i
                                                    class="bi bi-trash3"></i>
                                            </button>
                                        </div>
                                    @endif
                                    <div class="col text-end">
                                        <button class="custom-btn">{{ $item->countComment }} Komentar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>





    {{-- Modal Edit User --}}
    <div class="modal fade" id="ProfileEdit" tabindex="-1" aria-labelledby="ProfileEditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ProfileEditLabel">Edit Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile.update', auth()->user()->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-2" id="image-lama-user">
                            @if (auth()->user()->image)
                                <div class="mb-2">
                                    <img src="{{ asset('image/profile/' . auth()->user()->image) }}" class="img-fluid">
                                    <div class="text-muted">
                                        Foto Sebelumnya
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button type="button" class="btn btn-danger image-user">Hapus foto
                                        sebelumnya</button>
                                    <input type="hidden" name="id" id="id_user"
                                        value="{{ auth()->user()->id }}">
                                </div>
                            @endif

                        </div>
                        <input type="hidden" name="imageLama" id="imageLama" value="{{ auth()->user()->image }}">
                        <input type="hidden" name="imageHapus" id="image-hapus-user" value="">

                        <div class="mb-2">
                            <label for="image" class="form-label">
                                Upload Profile {{ auth()->user()->image ? 'Baru' : '' }}
                            </label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>

                        <div class="mb-2">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ auth()->user()->name }}">
                        </div>
                        <div class="mb-2">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ auth()->user()->email }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($data as $item)
        <!-- Modal Edit-->
        <div class="modal fade" id="BlogEditModal{{ $item->id }}" tabindex="-1"
            aria-labelledby="BlogEditModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="BlogCreateModalLabel">Edit Blog</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('blog.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-2" id="image-lama{{ $item->id }}">
                                @if ($item->image)
                                    <div class="mb-2">
                                        <img src="{{ asset('image/blogs/' . $item->image) }}" class="img-fluid">
                                        <div class="text-muted">
                                            Foto Sebelumnya
                                        </div>
                                    </div>
                                    <div class="d-grid">
                                        <button type="button" data-id={{ $item->id }}
                                            class="btn btn-danger image">Hapus foto sebelumnya</button>
                                    </div>
                                @endif

                            </div>
                            <input type="hidden" name="imageLama" id="imageLama{{ $item->id }}"
                                value="{{ $item->image }}">
                            <input type="hidden" name="imageHapus" id="image-hapus{{ $item->id }}" value="">

                            <div class="mb-2">
                                <label for="image" class="form-label">
                                    Upload File {{ $item->image ? 'Baru' : '' }}
                                </label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>

                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Tuliskan Blog Anda" name="description" id="description"
                                    style="height: 100px">{{ $item->description }}</textarea>
                                <label for="description">Comments</label>
                            </div>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach


    {{-- Modal Delete --}}
    @foreach ($data as $item)
        <div class="modal fade" id="BlogDeleteModal{{ $item->id }}" tabindex="-1"
            aria-labelledby="BlogDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="BlogDeleteModalLabel">Hapus Blog</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Yakin ingin menghapusnya ?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form action="{{ route('blog.destroy', $item->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-primary">Delete Blog</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endforeach



    <script>
        $(document).ready(function() {
            $('.image-user').on('click', function() {
                var id = $('#id_user').val()

                if (id) {
                    $('#image-lama-user').hide()
                    $('#image-hapus-user').val('on')
                }
            })

            $('.image').on('click', function() {
                var id = $(this).data('id')

                if (id) {
                    $('#image-lama' + id).hide()
                    $('#image-hapus' + id).val('on')
                }
            })

            $('.love').on('click', function() {
                var blog_id = $(this).data('id')
                var status = $('#status' + blog_id).val()
                var count = $('#count' + blog_id).val()

                if (status == 'off') {

                    $.ajax({
                        type: "POST",
                        url: "{{ route('love.store') }}",
                        data: {
                            _token: '{{ csrf_token() }}',
                            blog_id: blog_id
                        },
                        success: function(respons) {
                            console.log(respons)
                            $('#count-icon' + blog_id).html(parseInt(count) + 1)
                            // $('#count-icon'+blog_id).html(count+1)
                            $('#status' + blog_id).val('on')
                            $('#icon' + blog_id).addClass('bi bi-heart-fill text-danger')
                            $('#icon' + blog_id).removeClass('bi bi-heart')
                        }
                    })

                } else if (status == 'on') {
                    var love_id = $('#id_love' + blog_id).val()

                    $.ajax({
                        type: 'DELETE',
                        url: "{{ route('love.destroy', ['love' => '__love_id__']) }}"
                            .replace('__love_id__', love_id),
                        data: {
                            _token: '{{ csrf_token() }}',
                            love_id: love_id
                        },
                        success: function(respons) {
                            console.log(respons)
                            $('#count-icon' + blog_id).html(parseInt(count) - 1)
                            $('#status' + blog_id).val('off')
                            $('#icon' + blog_id).addClass('bi bi-heart')
                            $('#icon' + blog_id).removeClass('bi bi-heart-fill text-danger')
                        }
                    })
                }

            })





        })
    </script>
@endsection
