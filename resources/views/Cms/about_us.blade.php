
{{-- @extends('Master_layout.layout') --}}

@section('page-title')
    About Us
@endsection

{{-- @section('content') --}}
    <div class="container-fluid px-0 ">
        <div class="row shadow br_12px-s mt-4 mx-xl-4 mx-2 bg-white py-4">
            <div class="col-12">
                <h3 class="">About Us</h3>
            </div>

            <div class="col-12 mt-4">
                <p>Find a stylish new haircut, book last-minute nails, or treat yourself to a relaxing massage.Fresha is
                    easiest and most reliable way to book with local salons and spas. Top features include:Instant booking
                    confirmation, say goodbye to phone calls and schedule your appointments directly in the venue's live
                    calendar</p>
                <p class="mt-3"> Discover the best new salons and spas by searching across thousands of venues, all
                    with live online booking availability</p>
                <p class="mt-3">Stav in control of vour time with features to Book, Cancel, Reschedule and Rebook
                    vour own appointments, all without contacting the venue</p>
                <p class="mt-3">Find the best prices with exclusive online discounts for off-peak bookings and
                    last-minute reservations</p>
                <p class="mt-3">Read trusted, authentic ratings from customers who reviewed their in-store
                    experience</p>
                <p class="mt-3">Easilv find the way to vour appointment location with built-in map directions</p>
            </div>
        </div>
    </div>
{{-- @endsection --}}


@section('footer-scripts')
    <script src="{{ asset('assets/js/cms_pages.js') }}"></script>
@endsection

@section('header-css')
    <link rel="stylesheet" href="{{ asset('assets/css/course.css') }}" />
@endsection


@push('header-scripts')
@endpush
