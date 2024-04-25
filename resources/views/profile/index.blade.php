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
                <div class="row">
                    @if (auth()->user()->image)
                        <div class="col">
                            <img src="{{ asset('image/profile/' . auth()->user()->name) }}" class="foto-wrapper"
                                alt="{{ auth()->user()->name}}">
                        </div>
                    @else
                        <div class="col">
                            <img src="{{ asset('image/profil-default.png') }}" class="foto-wrapper"
                                alt="{{ auth()->user()->name }}">
                        </div>
                    @endif
                </div>
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
