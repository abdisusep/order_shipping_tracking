@extends('layouts.app')

@section('title', 'Tracking Pengiriman')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm border-0 p-4">
            <div class="card-body">
                <h4>Tracking</h4>
                @if (session('error'))
                    <div class="alert alert-danger border-0">{{ session('error') }}</div>
                @endif
                <form action="{{ route('tracking.track') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="tracking_id" class="form-label">Tracking ID</label>
                        <input type="text" class="form-control shadow-none @error('tracking_id') is-invalid @enderror" id="tracking_id" name="tracking_id" value="{{ $trackingId }}">
                        @error('tracking_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Lacak</button>
                </form>

                @if (isset($tracking))
                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-2">
                                        <span class="fw-bold">Nomor Resi</span><br>
                                        <span>{{ $tracking['waybill_id'] }}</span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="fw-bold">Kurir</span><br>
                                        <span>{{ strtoupper($tracking['courier']['company']) }}</span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="fw-bold">Status</span><br>
                                        <span>{{ ucfirst($tracking['status']) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <strong>Progress Tracking</strong> <br>
                                    <ul class="list-group mt-3">
                                    @foreach($tracking['history'] as $history)
                                        <li class="list-group-item">
                                            {{ $history['note'] }} <br>
                                            <small class="text-muted">Diperbarui: {{ \Carbon\Carbon::parse($history['updated_at'])->format('d M Y, H:i') }}</small>
                                        </li>
                                    @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection