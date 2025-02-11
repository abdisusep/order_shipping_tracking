@extends('layouts.app')
@section('title', 'Login')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm border-0 p-3">
                <div class="card-body">
                    <h4 class="mb-4">Login</h4>
                    @if(session('success'))
                        <div class="alert alert-success border-0">{{ session('success') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 pb-1">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control shadow-none" value="{{ old('email') }}">
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control shadow-none">
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection