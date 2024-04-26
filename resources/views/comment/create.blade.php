@foreach ($data->Comment as $item)
    <div class="row border rounded bg-light p-2 m-2">
        @if ($item->User->id == auth()->user()->id)
            <div class="row mb-1 ">
                <div class="col text-danger">
                    <i class="bi bi-person-bounding-box"></i> {{ $item->User->name }}
                </div>
                <div class="col text-end">
                    <button class="custom-btn" type="button" id="delete-comment" data-id="{{ $item->id }}">
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
                        <button class="custom-btn" type="button" id="delete-comment" data-id="{{ $item->id }}">
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
