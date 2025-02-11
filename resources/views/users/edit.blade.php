@extends('layouts.app')
@section('title', 'Edit User')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm border-0 p-4">
            <div class="card-body">
                <h4 class="mb-3">Edit User</h4>
                <a href="{{ route('users.index') }}" class="btn btn-dark btn-sm mb-3">< Back</a>
                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Password (optional)</label>
                        <input type="password" name="password" class="form-control" placeholder="********">
                    </div>
                    <div class="mb-3">
                        <label>Confirm Password (optional)</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="********">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection