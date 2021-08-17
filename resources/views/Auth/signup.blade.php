@extends('Auth.layouts.auth')

@section('auth-content')
    @include('Auth._partials.signup_content')
@endsection


@section('footer-scripts')
    <script src="{{ asset('assets/js/auth.js') }}"></script>
@endsection