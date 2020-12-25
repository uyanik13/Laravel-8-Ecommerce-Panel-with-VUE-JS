

<section class="p-t100 p-b60 bg-light">
    <div class="container">
        <div class="flex-row">
            <div class="col-md-4 col-xs-12 align-self-center">
                <div class="ot-heading heading-testimonials left-align">
                    <h6><span>{{__('lang.our_testimonials')}}</span></h6>
                    <h2 class="main-heading">{{__('lang.our_testimonials_desc')}}</h2>
                </div>
                <div class="testicustom-slider-nav"></div>
            </div>
            <div class="col-md-8 col-xs-12 ot-testimonials-heading">
                <div class="ot-testimonials">
                    <div class="testimonial-wrap">
                        <div class="testimonial-inner ot-testimonials-slider">


                            @isset($testimonials)
                                @foreach ($testimonials as $testimonial)
                                <div>
                                <img src="{{$testimonial['image']}}" alt="{{$testimonial['name']}}">
                                    <div class="ttext">
                                        {{$testimonial['comment']}}
                                    </div>
                                    <div class="tinfo">
                                        <h6>{{$testimonial['name']}}</h6>
                                        <span>{{$testimonial['position']}}</span>
                                    </div>
                                </div>
                                @endforeach
                            @endisset

                        </div>
                        <div class="bg-block"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
