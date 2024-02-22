@extends("layouts.index")
@section("title")
    <title>Evincode.Com - Trang chủ</title>
@endsection
@section("content")
    <div class="card shadow">
        <div class="card-body">
            @include('layouts.function')
            <div class="c-content-title-1 mt-5"><a><h2 class="c-center c-font-upper c-font-bold c-text-3xl">Các Tool
                        hiện có</h2></a>
                <div class="c-line-center c-theme-bg"></div>
            </div>
            <div class="container">
                <div class="row">
                    @if(count($list_product))
                        @foreach($list_product as $item)
                            <div class="col-sm-6 col-lg-4 col-xl-3 mb-0 p-1 BoxProduct shadow">
                                <div class="card h-100 text-center">
                                    <a href="{{route('detailProduct').'?id='.$item->id}}" title="{{$item->name}}">
                                        <img class="card-img-top" src="{{$item->image}}"
                                                                                   alt="Card Image" width="608"
                                                                                   height="380"> </a>
                                    <div class="card-body">
                                        <div>
                                            <h5 class="card-title BoxProduct-title c-text-xl">{{$item->name}}</h5>
                                            <font color="red" class="c-text-lg c-font-bold">{{number_format($item->price, 0, ',', '.')}} vnđ</font>
                                            <p class="card-text">- {{$item->note1}}</p>
                                            <p class="card-text">- {{$item->note2}}</p>
                                            <p class="card-text">- {{$item->note3}}</p>
                                        </div>
                                        <a href="{{route('detailProduct').'?id='.$item->id}}" class="btn button-blue d-block shadow">Xem
                                            Ngay</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center">
                            <p>Không có sản phẩm nào</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <a href="#" disabled class="btn btn-outline-success">Xem toàn bộ</a></div>
            <div id="slider-function" class="carosel-scale center mt-3">
                <div class="owl-carousel owl-theme">
                    <div class="item-slide"><img src="https://tuanxinh.com/images/sidebar/footer/ft-1.png"/>
                    </div>
                    <div class="item-slide"><img src="https://tuanxinh.com/images/sidebar/footer/ft-2.png"/>
                    </div>
                    <div class="item-slide"><img src="https://tuanxinh.com/images/sidebar/footer/ft-3.png"/>
                    </div>
                    <div class="item-slide"><img src="https://tuanxinh.com/images/sidebar/footer/ft-4.png"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("js_location")
    <script src="{{asset('js/danh-muc-san-pham.js?t='.Carbon\Carbon::now()->timestamp)}}"></script>
@endsection
