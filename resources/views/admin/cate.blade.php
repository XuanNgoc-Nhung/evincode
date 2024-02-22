@extends("admin.layout.app")
@section("title")
    <title>Admin - danh sách danh mục sản phẩm</title>
@endsection
@section("content")
    <div>
        <div id="app">
            <danh-muc/>
        </div>
    </div>
@endsection
@section("js_location")
    <script src="{{asset('js/danh-muc-san-pham.js?t='.Carbon\Carbon::now()->timestamp)}}"></script>
@endsection
