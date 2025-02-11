@extends('layouts.app')
@section('title', 'Register')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm border-0 p-3">
                <div class="card-body">
                    <h4 class="mb-4">Register</h4>
                    @if ($errors->any())
                        <div class="alert alert-danger pb-1 border-0">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control shadow-none" value="{{ old('name') }}">
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control shadow-none" value="{{ old('email') }}">
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control shadow-none">
                        </div>
                        <div class="mb-3">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control shadow-none">
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection