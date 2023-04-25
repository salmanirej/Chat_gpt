@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Messages List</h1>
        <a href="{{ route('messages.create') }}" class="btn btn-primary mb-3">Create New Message</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Message</th>
                    <th>Sender ID</th>
                    <th>Receiver ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                    <tr>
                        <td>{{ $message->id }}</td>
                        <td>{{ $message->message }}</td>
                        <td>{{ $message->sender_id }}</td>
                        <td>{{ $message->receiver_id }}</td>
                        <td>
                            <a href="{{ route('messages.edit', $message->id) }}" class="btn btn-primary btn-sm mr-2">Edit</a>
                            <form action="{{ route('messages.destroy', $message->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
