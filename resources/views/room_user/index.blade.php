@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Room User</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User ID</th>
                                    <th>Room ID</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($room_users as $room_user)
                                    <tr>
                                        <td>{{ $room_user->id }}</td>
                                        <td>{{ $room_user->user_id }}</td>
                                        <td>{{ $room_user->room_id }}</td>
                                        <td>
                                            <a href="{{ route('room_user.edit', $room_user->id) }}" class="btn btn-primary">Edit</a>
                                            <form action="{{ route('room_user.destroy', $room_user->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('room_user.create') }}" class="btn btn-success">Create</a>
               
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
