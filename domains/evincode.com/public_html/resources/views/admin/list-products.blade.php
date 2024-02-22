@extends("admin.layout.app")
@section("title")
    <title>Admin - Danh sách sản phẩm</title>
@endsection
@section("content")
    <div>
        <div id="app">
            <admin-list-products/>
        </div>
    </div>
@endsection
@section("js_location")
    <script src="{{asset('js/admin-list-products.js?t='.Carbon\Carbon::now()->timestamp)}}"></script>
@endsection
