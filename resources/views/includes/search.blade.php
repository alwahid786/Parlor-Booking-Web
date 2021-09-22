
@if ($book_salon == 1)
    <div>in booking page</div>
@else


<div class="container">
    <div class="wellcome_GLITTER_ups">
        <p>WELLCOME TO</p>
        <h1>Glitter<span class="for_text_yellow_color">UPS</span>
        </h1>
        <h1 class="for_text_yellow_color">FOR REAL WOMEN'S</h1>

        <p class="for_text_dummy">
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam
        <br>
        <span>nonummy nibh euismod</span>
        </p>
    </div>


        <div class="finds_deal_on_parlour">
            <div class="centered-query">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-12">
                        <div class="input-group">
                                <form action="{{ route('search') }}" id="frm_search-d" method="post">
                                    @csrf
                                    <input type="text" name="keyword" class="form-control input-text one fa fa-university" id="keyword-d" aria-hidden="true"  placeholder="What You Looking For">
                                        @error('keyword')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                    <input type="text" name="location"  class="form-control input-text two fa fa-university" id="location-d" aria-hidden="true"  placeholder="Location">
                                    {{-- <input type="text" class="form-control input-text two fa fa-university" aria-hidden="true"  placeholder="Date">  --}}
                                        @error('location')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    <div class="input-group-append">
                                    <button type="submit" class="btn search_btn_bg">Search</button>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endif
