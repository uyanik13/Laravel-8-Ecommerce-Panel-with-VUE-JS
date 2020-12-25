<section class="p-b120">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="partners">
                    <div class="owl-carousel home-client-carousel">
                        @foreach ($partners as $partner)
                        <div class="partners-slide">
                            <a class="client-logo">
                               <figure class="partners-slide-inner">
                                <img class="partners-slide-image" src="@isset($partner['image']) {{$partner['image']}} @endisset" alt="@isset($partner['image']) {{$partner['name']}} @endisset">
                              </figure>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
