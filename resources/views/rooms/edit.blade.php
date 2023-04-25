@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Room</h1>
        <form action="{{ route('rooms.update', $room->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ $room->name }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="description" value="{{ $room->description }}" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
