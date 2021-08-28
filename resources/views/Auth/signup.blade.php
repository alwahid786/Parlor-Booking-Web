@extends('Auth.layouts.auth')

@section('auth-content')
    @include('Auth._partials.signup_content')
@endsection


@section('footer-scripts')
    <script src="{{ asset('assets/js/auth.js') }}"></script>
    <script>
        let verify_account_page_link = "{{ route('enterCode') }}";
        // let SaloonDashboard = "{{ route('saloonDashboard') }}";

    </script>
@endsection
