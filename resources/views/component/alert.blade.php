@if (session('error'))
    <div class="alert alert-danger">
        <strong>Gagal !!</strong> {{ session('error') }}
    </div>
@elseif (session('success'))
    <div class="alert alert-success">
        <strong>Sukses !!</strong> {{ session('success') }}
    </div>
@endif
