@extends('layouts.admin')

@section('content')

<div class="p-6 bg-white rounded shadow">

    <h1 class="text-xl font-bold mb-4">
        Edit Lease
    </h1>

    <form method="POST"
          action="{{ route('leases.update', $lease) }}">

        @csrf
        @method('PUT')

        @include('admin.leases.form')

        <button type="submit" class="mt-4 bg-green-600 text-white px-4 py-2 rounded">
            Update
        </button>

    </form>

</div>

@endsection