@extends('component.app')


@section('content')
    <div class="container mb-5" style="margin-top:75px">
        <div class="row">
            <div class="col text-center border-bottom p-3">
                <h3>Konten Blog</h3>
                <p>Buat cerita hari ini kamu dan share ke teman kamu!</p>
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
                            <input type="text" name="search" id="search-blog" class="form-control">
                            <span class="input-group-text" id="basic-addon2">Search Blog</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-1 d-flex justify-content-center">
            <div class="col-9" id="blog">
                @foreach ($data as $item)
                    {{-- @dd($item->image) --}}
                    <div class="card p-4 m-1">
                        <div class="row">
                            @if ($item->User->image)
                                <div class="col-md-1">
                                    <img src="{{ asset('image/profile/' . $item->User->image) }}" class="foto-wrapper"
                                        alt="{{ $item->User->name }}">
                                </div>
                            @else
                                <div class="col-md-1">
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

                        <div class="row">
                            <div class="col-1">
                                <button class="custom-btn"><i class="bi bi-heart"></i></button>
                            </div>
                            <div class="col-1 ">
                                <a href="{{ route('blog.show', $item->id) }}" class="custom-btn mt-1 text-decoration-none text-dark"><i
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
                                        data-bs-target="#BlogDeleteModal{{ $item->id }}"><i class="bi bi-trash3"></i>
                                    </button>
                                </div>
                            @endif
                            <div class="col text-end">
                                <button class="custom-btn">{{$item->countComment}} Komentar
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>



    {{-- Modal Create --}}
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
                            <!-- Input file baru -->
                            <div class="mb-2">
                                <label for="image" class="form-label">
                                    Upload File {{ $item->image ? 'Baru' : '' }}
                                </label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                            <!-- Textarea untuk deskripsi -->
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Tuliskan Blog Anda" name="description" id="description"
                                    style="height: 100px">{{ $item->description }}</textarea>
                                <label for="description">Comments</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!-- Tombol tutup modal -->
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <!-- Tombol simpan perubahan -->
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
            $('.image').on('click', function() {
                var id = $(this).data('id')

                if (id) {
                    $('#image-lama' + id).hide()
                    $('#image-hapus' + id).val('on')
                }
            })

            $('#search-blog').on('keyup', function() {
                var keyword = $(this).val()
                $.ajax({
                    type: 'GET',
                    url: "{{ route('search.blog') }}",
                    data: {
                        keyword: keyword
                    },
                    success: function(data) {
                        $('#blog').html(data)
                    }
                })
            })
        })
    </script>
@endsection
