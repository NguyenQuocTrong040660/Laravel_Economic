
<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Danh mục sản phẩm</h2>
        <!--category-products-->
        <div class="panel-group category-products" id="accordian">
            @foreach($all_categogies as $categogies)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        @if($categogies->categogiesChild->count())
                        <a data-toggle="collapse" data-parent="#accordian" href="#sportswear_{{$categogies->id}}">

                            <span class="badge pull-right">
                             {{--  neu co categogies Child thi moi co dau + --}}
                                @if($categogies->categogiesChild->count())
                                <i class="fa fa-plus"></i>
                                @endif
                            </span>
                           {{$categogies->name}}
                        </a>
                        @endif
                    </h4>
                </div>
                <div id="sportswear_{{$categogies->id}}" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            @foreach($categogies->categogiesChild as $categogiesChildrent)
                            <li><a href="{{route('category.product',
                           ['slug'=>$categogiesChildrent->slug, 'id'=>$categogiesChildrent->id])}}">
                                    {{$categogiesChildrent->name}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div><!--/category-products-->



        <div class="shipping text-center"><!--shipping-->
            <img src="Eshopper/images/img_slidbar.png" height="400" alt="quang cao " />
        </div><!--/shipping-->

    </div>
</div>
