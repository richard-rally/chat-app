@extends('layouts.app')

@section('content')
    <div class="card p-5 m-2">

        <form class="row" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" name="email" class="form-control" id="staticEmail">
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password"
                           name="password" class="form-control" id="inputPassword">
                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary mb-3">Login</button>

            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                Need to register to access the chat?
            </a>
        </form>

    </div>
@endsection