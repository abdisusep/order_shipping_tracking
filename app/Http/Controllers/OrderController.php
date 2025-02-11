<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $orders = Order::all();
        } else {
            $orders = Order::where('user_id', auth()->id())->get();
        }

        return view('orders.index', compact('orders'));
    }


    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'origin_contact_name' => 'required|string',
            'origin_contact_phone' => 'required|string',
            'origin_address' => 'required|string',
            'origin_postal_code' => 'required|string',
            'destination_contact_name' => 'required|string',
            'destination_contact_phone' => 'required|string',
            'destination_address' => 'required|string',
            'destination_postal_code' => 'required|string',
            'destination_note' => 'nullable|string',
            'courier_company' => 'required|string',
            'items' => 'required|json',
        ]);

        $payload = [
            "shipper_contact_name" => Auth::user()->name,
            "origin_contact_name" => $request->origin_contact_name,
            "origin_contact_phone" => $request->origin_contact_phone,
            "origin_address" => $request->origin_address,
            "origin_postal_code" => $request->origin_postal_code,
            "destination_contact_name" => $request->destination_contact_name,
            "destination_contact_phone" => $request->origin_postal_code,
            "destination_address" => $request->destination_address,
            "destination_postal_code" => $request->destination_postal_code,
            "courier_company" => $request->courier_company,
            "courier_type" => "reg",
            "delivery_type" => "now",
            "items" => [
                [
                    "name" => $request->item_name,
                    "description" => $request->item_desc,
                    "value" => $request->item_value,
                    "quantity" => $request->item_qty
                ]
            ]
        ];
    
        $apiKey = env('BITESHIP_API_KEY');
        $response = Http::withHeaders([
            'Authorization' => "Bearer $apiKey",
            'Content-Type' => 'application/json'
        ])->post('https://api.biteship.com/v1/orders', $payload);
    
        if ($response->successful()) {
            $biteshipData = $response->json();

            $validated['shipper_contact_name'] = Auth::user()->name;
            $order = Order::create($validated);
            $order->update([
                'order_id' => $biteshipData['id'] ?? null,
                'tracking_id' => $biteshipData['courier']['tracking_id'] ?? null,
                'waybill_id' => $biteshipData['courier']['waybill_id'] ?? null,
                'status' => $biteshipData['status'] ?? null
            ]);
            
            return redirect()->route('orders')->with('success', 'Create order berhasil');
        } else {
            return redirect()->back()->withInput();
        }
    }

    public function tracking()
    {
        return view('orders.tracking');
    }

    public function trackOrder(Request $request)
    {
        $request->validate([
            'tracking_id' => 'required|string',
        ]);

        $trackingId = $request->tracking_id;
        $apiKey = env('BITESHIP_API_KEY');
        $url = "https://api.biteship.com/v1/trackings/{$trackingId}";

        $response = Http::withHeaders([
            'Authorization' => "Bearer $apiKey",
            'Content-Type' => 'application/json',
        ])->get($url);
        

        if ($response->successful()) {
            $tracking = $response->json();
            return view('orders.tracking', compact('tracking', 'trackingId'));
        } else {
            return redirect()->route('tracking')->with('error', 'Nomor tracking tidak ditemukan atau terjadi kesalahan.');
        }
    }
}
