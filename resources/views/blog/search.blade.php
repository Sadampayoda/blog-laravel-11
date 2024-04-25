@if ($data)
    @foreach ($data as $item)
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
                <div class="col-1">
                    <button class="custom-btn"><i class="bi bi-chat-square"></i>
                    </button>
                </div>
                @if (auth()->user()->id == $item->User->id)
                    <div class="col-1">
                        <button type="button" class="custom-btn" data-bs-toggle="modal"
                            data-bs-target="#BlogEditModal{{ $item->id }}"><i class="bi bi-pencil-square"></i></i>
                        </button>

                    </div>
                    <div class="col-1">
                        <button type="button" class="custom-btn" data-bs-toggle="modal"
                            data-bs-target="#BlogDeleteModal{{ $item->id }}"><i class="bi bi-trash3"></i>
                        </button>
                    </div>
                @endif
                <div class="col text-end">
                    <button class="custom-btn">0 Komentar
                    </button>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="row">
        <div class="col text-center">
            <p class="fs-2 text-muted">Blog tidak ditemukan</p>
        </div>
    </div>
@endif

