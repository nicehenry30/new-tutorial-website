@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('admin.subscriptions.index') }}" method="GET" class="mb-4">
        @csrf
        <input type="text" name="search" placeholder="Search subscriptions..." class="border p-2 rounded" value="{{ request('search') }}">
        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Search</button>
         <h1 class="text-xl font-bold mb-4">Subscriptions</h1>
    </form>
    @if($subscriptions->count())
        <table class="table-auto w-full border">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Category</th>
                    <th>Plan</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subscriptions as $subscription)
                    <tr>
                        <td>{{ $subscription->id }}</td>
                        <td>{{ $subscription->user_id }}</td>
                        <td>{{ $subscription->category }}</td>
                        <td>{{ $subscription->plan }}</td>
                        <td>{{ $subscription->amount }}</td>
                        <td>{{ $subscription->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No subscriptions found.</p>
    @endif
</div>

@endsection
