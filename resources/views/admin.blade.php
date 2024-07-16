@extends('layouts.app')

@section('content')
    <router-view :user="{{ Auth::user() }}"></router-view>
@endsection
