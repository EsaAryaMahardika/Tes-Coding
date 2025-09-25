@extends('layout')
@section('content')
<div class="row clearfix">
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card">
            <div class="body">
                <h3 class="mb-1">{{ $content }}</h3>
                <div>Total Konten</div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card">
            <div class="body">
                <h3 class="mb-1">{{ $author }}</h3>
                <div>Total Author</div>
            </div>
        </div>
    </div>
</div>
@endsection