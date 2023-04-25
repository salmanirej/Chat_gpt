@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Rooms List</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rooms as $room)
                            <tr>
                                <td>{{ $room->id }}</td>
                                <td>{{ $room->name }}</td>
                                <td>{{ $room->description }}</td>
                                <td>
                                    <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('rooms.create') }}" class="btn btn-success">Add Room</a>
            </div>
        </div>
    </div>
@endsection
