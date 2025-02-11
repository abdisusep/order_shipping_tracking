@extends('layouts.app')
@section('title', 'Create Order')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm border-0 p-4">
            <div class="card-body">
                <h4 class="mb-3">Create Order</h4>
                <a href="{{ route('orders') }}" class="btn btn-dark btn-sm mb-3">< Back</a>
                @if ($errors->any())
                        <div class="alert alert-danger pb-1 border-0">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                @endif
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Data Pengirim</h5>
                            <div class="mb-3">
                                <label>Nama Pengirim</label>
                                <input type="text" name="origin_contact_name" class="form-control shadow-none" value="{{ old('origin_contact_name') }}">
                            </div>
                            <div class="mb-3">
                                <label>Telepon Pengirim</label>
                                <input type="text" name="origin_contact_phone" class="form-control shadow-none" value="{{ old('origin_contact_phone') }}">
                            </div>
                            <div class="mb-3">
                                <label>Alamat Asal</label>
                                <textarea name="origin_address" class="form-control shadow-none">{{ old('origin_address') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label>Kode Pos Asal</label>
                                <input type="number" name="origin_postal_code" class="form-control shadow-none" value="{{ old('origin_postal_code') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>Data Penerima</h5>
                            <div class="mb-3">
                                <label>Nama Penerima</label>
                                <input type="text" name="destination_contact_name" class="form-control shadow-none" value="{{ old('destination_contact_name') }}">
                            </div>
                            <div class="mb-3">
                                <label>Telepon Penerima</label>
                                <input type="text" name="destination_contact_phone" class="form-control shadow-none" value="{{ old('destination_contact_phone') }}">
                            </div>
                            <div class="mb-3">
                                <label>Alamat Penerima</label>
                                <textarea name="destination_address" class="form-control shadow-none">{{ old('destination_address') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label>Kode Pos Penerima</label>
                                <input type="number" name="destination_postal_code" class="form-control shadow-none" value="{{ old('destination_postal_code') }}"> 
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Kurir</label>
                        <select name="courier_company" class="form-control shadow-none">
                            <option value="jne">JNE</option>
                            <option value="jnt">J&T</option>
                            <option value="sicepat">SiCepat</option>
                        </select>
                    </div>

                    <h5>Jenis Barang</h5>
                    <div id="itemContainer">
                        <div class="item">
                            <input type="text" name="item_name" class="form-control shadow-none mb-2 item-name" placeholder="Nama Barang">
                            <input type="text" name="item_desc" class="form-control shadow-none mb-2 item-description" placeholder="Deskripsi">
                            <input type="number" name="item_value" class="form-control shadow-none mb-2 item-value" placeholder="Harga (Rp)">
                            <input type="number" name="item_qty" class="form-control shadow-none mb-2 item-quantity" placeholder="Jumlah" oninput="prepareItems()">
                        </div>
                    </div>

                    <input type="hidden" name="items" id="itemsInput">
                    <button type="submit" class="btn btn-success mt-3">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    function prepareItems() {
        let items = [];
        document.querySelectorAll("#itemContainer .item").forEach((item) => {
            let quantity = item.querySelector(".item-quantity").value;
            
            if (quantity > 0) {
                let newItem = {
                    name: item.querySelector(".item-name").value,
                    description: item.querySelector(".item-description").value,
                    value: item.querySelector(".item-value").value,
                    quantity: quantity
                };
                items.push(newItem);
            }
        });

        document.getElementById("itemsInput").value = JSON.stringify(items);
    }
</script>
@endsection