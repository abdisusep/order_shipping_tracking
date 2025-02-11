@extends('layouts.app')
@section('title', 'List Orders')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm border-0 p-4">
            <div class="card-body">

                <h4 class="mb-3">List Orders</h4>
                
                @if (session('success'))
                    <div class="alert alert-success border-0">{{ session('success') }}</div>
                @endif

                <a href="{{ route('orders.create') }}" class="btn btn-dark btn-sm mb-3">Create</a>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tracking ID</th>
                            <th>Nomor Resi</th>
                            <th>Nama Pengirim</th>
                            <th>Nama Penerima</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $index => $order)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $order->tracking_id ?? '-' }}</td>
                            <td>{{ $order->waybill_id ?? '-' }}</td>
                            <td>{{ $order->origin_contact_name }}</td>
                            <td>{{ $order->destination_contact_name }}</td>
                            <td>
                                <span class="badge bg-{{ $order->status == 'delivered' ? 'success' : 'warning' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada order</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
