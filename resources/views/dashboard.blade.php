@extends('layouts.app')

@section('content')
    <app
        :user="{{\App\Http\Resources\UserResource::make(\Illuminate\Support\Facades\Auth::user())->toJson()}}"
        csrf="{{ csrf_token() }}"
    ></app>
@endsection