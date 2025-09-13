<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::create([
            'total_operator' => 150000,
            'total_supplier' => 155000,
            'document_operator' => 'docs/operator1.pdf',
            'document_supplier' => 'docs/supplier1.pdf',
            'status' => 'pending',
            'date' => now(),
            'supplier_id' => 'supplier 1',
            'user_id' => 1,
            'type' => 'pembelian',
            'invoice' => 'INV-001',
            'total' => 150000,

        ]);
    }
}
