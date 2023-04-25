@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Create Room User</div>
                    <div class="card-body">
                        <form action="{{ route('room_user.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="user_id">User ID:</label>
                                <input type="text" class="form-control" id="user_id" name="user_id" required>
                            </div>
                            <div class="form-group">
                                <label for="room_id">Room ID:</label>
                                <input type="text" class="form-control" id="room_id" name="room_id" required>
                            </div>
                            <button type="submit" class="btn btn-success">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
