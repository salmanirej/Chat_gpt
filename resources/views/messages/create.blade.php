@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Message</h1>
        <form action="{{ route('messages.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="message">Message:</label>
                <input type="text" name="message" class="form-control @error('message') is-invalid @enderror" value="{{ old('message') }}">
                @error('message')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="sender_id">Sender ID:</label>
                <input type="number" name="sender_id" class="form-control @error('sender_id') is-invalid @enderror" value="{{ old('sender_id') }}">
                @error('sender_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label
