@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('error'))
<div class="alert alert-danger text-white bg-danger border-0 text-center">
    {{ session('error') }}
</div>
@endif