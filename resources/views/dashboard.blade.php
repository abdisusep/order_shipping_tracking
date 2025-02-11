@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h4>Welcome {{ Auth::user()->name }}</h4>
                Jumlah Order : {{ $jumlah_order }}
            </div>
        </div>
    </div>
</div>
@endsection