@extends('layouts.app')
@section('title', 'Create User')

@section('content')
<div class="max-w-3xl mx-auto py-10">

    <h1 class="text-2xl font-bold mb-6">Create customer</h1>

    @if ($errors->any())
    <div class="bg-red-100 text-red-800 p-4 mb-6 rounded">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


  GNU nano 6.2                        resources/views/backend/admin/customers/create.blade.php                                 @extends('layouts.app')

@section('title', 'Create User')

@section('content')
<div class="max-w-3xl mx-auto py-10">

    <h1 class="text-2xl font-bold mb-6">Create customer</h1>

    @if ($errors->any())
    <div class="bg-red-100 text-red-800 p-4 mb-6 rounded">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <form action="{{ route('backend.admin.customers.store') }}" method="POST" class="space-y-4">
        @csrf