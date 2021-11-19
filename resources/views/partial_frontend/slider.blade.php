<section id="slider">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">

                        @foreach($all_slider as $key => $slider)
                        <div class="item {{ $key == 0 ? 'active' : '' }}">
{{--                            <div class="col-sm-4 ">--}}
{{--                                <h1>SHOP69T</h1>--}}
{{--                                <h2>{{$slider->name}}</h2>--}}
{{--                                <p>{{$slider->description}} </p>--}}
{{--                                <button type="button" class="btn btn-default get">Get it now</button>--}}
{{--                            </div>--}}
                            <div class="col-sm-12 col-md-12">
                                <img src="{{$slider->image_path}}" width="100%"  alt="" />


                            </div>
                        </div>
                        @endforeach



                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>
