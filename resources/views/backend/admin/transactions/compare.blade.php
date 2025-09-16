@extends('layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-xl font-semibold mb-4">Compare Transaction (Invoice: {{ $invoice }})</h2>

    <table class="table-auto border w-full">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2">Field</th>
                <th class="px-4 py-2">Operator</th>
                <th class="px-4 py-2">Supplier</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border px-4 py-2">Total</td>
                <td class="border px-4 py-2">{{ $operatorData['total'] }}</td>
                <td class="border px-4 py-2">{{ $supplierData['total'] }}</td>
            </tr>
            <tr>
                <td class="border px-4 py-2">Dokumen</td>
                <td class="border px-4 py-2">
                    @if($operatorData['document'] !== 'Tidak ada')
                        <a href="{{ asset('storage/'.$operatorData['document']) }}" 
                           target="_blank" 
                           class="text-blue-600">Lihat</a>
                    @else
                        Tidak ada
                    @endif
                </td>
                <td class="border px-4 py-2">
                    @if($supplierData['document'] !== 'Tidak ada')
                        <a href="{{ asset('storage/'.$supplierData['document']) }}" 
                           target="_blank" 
                           class="text-blue-600">Lihat</a>
                    @else
                        Tidak ada
                    @endif
                </td>
            </tr>
        </tbody>
    </table>

    <form action="{{ route('backend.admin.transactions.approve', $invoice) }}" method="POST" class="mt-4">
        @csrf
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
            Approve
        </button>
    </form>
</div>
@endsection
