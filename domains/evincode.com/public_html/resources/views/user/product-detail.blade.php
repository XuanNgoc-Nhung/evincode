@extends("layouts.index")
@section("title")
    <title>{{$product_detail->name}} - Evincode.Com  </title>
@endsection
@section("content")
    <div class="card shadow">
        <div class="card-body">
            <div class="container">
                <div class="row">
                    @if(isset($product_detail))
                        <div class="c-content-title-1 mt-5"><a><h2
                                    class="c-center c-font-upper c-font-bold c-text-3xl">{{$product_detail->name}}</h2>
                            </a>
                            <div class="c-line-center c-theme-bg"></div>
                        </div>
                        <div id="detail-prod" class="container">
                            <div class="row mx-auto">
                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="container">
                                                <div class="img-box mx-auto shadow"><img
                                                        src="{{$product_detail->image}}"
                                                        alt="{{$product_detail->name}}" class="rounded">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="product-box">
                                                <h5 class="product-title">{{$product_detail->name}}</h5>
                                                <div class="group-status"><span class="status-title">Người Bán: <a
                                                            href="https://t.me/Duyhungbcx"
                                                            class="status-name">Admin EvinCode</a></span>
                                                </div>
                                                <div class="price-box"><span class="price" style="color: red">{{number_format($product_detail->price, 0, ',', '.')}} <span style="color:#008744">vnđ</span> </span>
                                                </div>
                                                <div class="price-box"><span class="status-title">Thời Hạn: <a
                                                            class="status-name">Vĩnh viễn</a></span>
                                                </div>

                                                <div class="product-description">
                                                    <ul>
                                                        <li>- {{$product_detail->note1}}
                                                        </li>
                                                        <li>- {{$product_detail->note2}}
                                                        </li>
                                                        <li>- {{$product_detail->note3}}
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="c-mt-3 row">
                                                    <div class="col-12 col-xl-6 d-grid c-mt-2">
                                                        <button type="button"
                                                                class="btn btn-dark shadow-lg p-3 hover:c-text-red-600"
                                                                onclick="anMuaSanPham()"><span class="text-1"> Mua Ngay</span>
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm specifications-box">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col" colspan="2" class="text-center"><span
                                                                class="nav-link text-dark">THÔNG TIN SẢN PHẨM</span>
                                                        </th>
                                                    </tr>
                                                    </thead>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="description c-text-left c-mt-2">
                                    {!! $product_detail->detail!!}
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center">
                            <p>Không có sản phẩm nào</p>
                        </div>
                    @endif
                </div>
            </div>
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
        <script>
            function anMuaSanPham(){
                swal({
                    title: 'Mua Dịch Vụ',
                    text: "Để mua và sử dụng sản phẩm vui lòng liên hệ với admin. Xin cảm ơn.",
                    icon: "success",
                    buttons: [
                        'Đóng',
                        'Đã hiểu'
                    ],
                    dangerMode: true,
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        swal("Đóng", "Evincode.Com cảm ơn bạn đã đồng hành", "success");
                    } else {
                        swal("Đóng", "Evincode.Com cảm ơn bạn đã đồng hành", "success");
                    }
                })
            }
        </script>
    </div>
@endsection
@section("js_location")
    <script src="{{asset('js/danh-muc-san-pham.js?t='.Carbon\Carbon::now()->timestamp)}}"></script>
@endsection
