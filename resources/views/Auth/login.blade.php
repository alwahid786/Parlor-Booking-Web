@extends('Auth.layouts.auth')

@section('auth-content')
    @include('Auth._partials.login_content')
@endsection


@section('footer-scripts')
    <script src="{{ asset('assets/js/auth.js') }}">
        // let SaloonDashboard = "{{ route('saloonDashboard') }}";
    </script>
@endsection
