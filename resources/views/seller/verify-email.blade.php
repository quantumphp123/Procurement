@extends('seller.layouts.seller')

@section('content')
<style>
    /* Background for entire page */
    body, html {
        height: 100%;
        margin: 0;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen,
            Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        background-color: #f5f7fa;
        color: #333;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .container {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .card {
        background: #ffffff;
        max-width: 480px;
        width: 100%;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        padding: 40px 30px;
        box-sizing: border-box;
        text-align: center;
    }

    .card-header {
        font-size: 2rem;
        font-weight: 700;
        color: #1a202c;
        margin-bottom: 16px;
        letter-spacing: 0.05em;
    }

    .alert {
        background-color: rgba(250, 106, 95, 0.1);
        border: 1px solid rgba(250, 106, 95, 0.5);
        color: rgb(250, 106, 95);
        padding: 16px 20px;
        border-radius: 8px;
        margin-bottom: 30px;
        font-weight: 600;
        font-size: 1rem;
    }

    .info-text {
        font-size: 1.125rem;
        line-height: 1.5;
        color: #4a5568;
        margin-bottom: 20px;
    }

    form {
        display: inline;
    }

    .btn-resend {
        background-color: rgb(250, 106, 95);
        border: none;
        color: white;
        padding: 10px 24px;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.25s ease;
        display: inline-block;
        margin-top: 12px;
        box-shadow: 0 4px 10px rgba(250, 106, 95, 0.3);
        user-select: none;
    }

    .btn-resend:hover,
    .btn-resend:focus {
        background-color: rgba(250, 106, 95, 0.8);
        outline: none;
        box-shadow: 0 6px 14px rgba(250, 106, 95, 0.5);
    }

    .btn-resend:active {
        background-color: rgba(250, 106, 95, 1);
    }

    .small-text {
        font-size: 0.95rem;
        color: #718096;
        margin-top: 16px;
        letter-spacing: 0.02em;
    }

    .icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 20px; /* Center the image */
        display: block; /* Make the image a block element */
    }
</style>

<div class="container">
    <div class="card" role="main" aria-label="Email Verification">
        <img src="{{ asset('img/icons/email-verify.png') }}" alt="Verification Icon" class="icon">
        <h1 class="card-header">{{ __('Verify Your Email Address') }}</h1>

        @if (session('resent'))
            <div class="alert" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        <p class="info-text">{{ __('Before proceeding, please check your email for a verification link.') }}</p>

        <p class="info-text">{{ __('If you did not receive the email') }}</p>

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn-resend" aria-label="Resend verification email">
                {{ __('Resend Verification Email') }}
            </button>
        </form>

        <p class="small-text">Thank you for using our service.</p>
    </div>
</div>
@endsection
