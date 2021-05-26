@if ($errors->count())
<div class="alert alert-danger">
    <ul class="alert-ul">
        @foreach ($errors->all() as $error)
        <li class="alert-li">{{ $error }}</li>
        @endforeach
    </ul>
  </div>
@endif
@if (session('flash_message'))
    <div class="flash_message alert alert-danger">
        {{ session('flash_message') }}
    </div>
@endif