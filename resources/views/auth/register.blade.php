@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-bold text-center text-blue-600 mb-6">{{ __('Register') }}</h2>
        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf
            <div>
                <label for="name" class="block text-gray-700 font-semibold mb-1">{{ __('Name') }}</label>
                <input id="name" type="text" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400 @error('name') border-red-500 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="email" class="block text-gray-700 font-semibold mb-1">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-gray-700 font-semibold mb-1">{{ __('Password') }}</label>
                <input id="password" type="password" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400 @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password-confirm" class="block text-gray-700 font-semibold mb-1">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" name="password_confirmation" required autocomplete="new-password">
            </div>
            <div>
                <label for="currency_id" class="block text-gray-700 font-semibold mb-1">{{ __('Currency') }}</label>
                <select class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" name="currency_id" id="currency_id">
                    @foreach($currencies as $currency)
                        <option value="{{ $currency->id }}">{{ $currency->title }}</option>
                    @endforeach
                </select>
                @error('currency_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded transition">{{ __('Register') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
