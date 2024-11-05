@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Email Verification</h1>
    <p>Please verify your email address by clicking the link we just sent to your email. If you didn't receive the email, click below to request another.</p>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn btn-primary">Resend Verification Email</button>
    </form>
</div>
@endsection
