
@if ($book_salon == 1)
    <div>in booking page</div>
@else


<div class="container ">
    <div class="wellcome_GLITTER_ups mx-auto">
        <p>WELLCOME TO</p>
        <h1>Glitter<span class="for_text_yellow_color">UPS</span>
        </h1>
        <h1 class="for_text_yellow_color">FOR REAL WOMEN'S</h1>

        <p class="for_text_dummy">
        People to look and feel their best – which is why we're trusted by millions of customers and thousands of businesses worldwide
        <br>
        <!-- <span>nonummy nibh euismod</span> -->
        </p>
    </div>


        <div class="finds_deal_on_parlour mx-ato ms-0">
            <div class="centered-query">
                <div class="row">
                    <div class="col-lg-10 col-12">
                        <div class="input-group">
                                <form action="{{ route('search') }}" id="frm_search-d" class="d-flex w-100 br_3px_yellow-s" method="post">
                                    @csrf
                                    <input type="text" name="keyword" class="form-control one fa fa-university bg_white-s me-1" id="keyword-d" aria-hidden="true"  placeholder="What You Looking For">
                                        @error('keyword')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                    <input type="text" name="location"  class="form-control two fa fa-university bg_white-s me-1" id="location-d" aria-hidden="true"  placeholder="Location">
                                    {{-- <input type="text" class="form-control two fa fa-university" aria-hidden="true"  placeholder="Date">  --}}
                                        @error('location')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    <div class="input-group-append">
                                    <button type="submit" class="btn search_btn_bg ">Search</button>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endif
