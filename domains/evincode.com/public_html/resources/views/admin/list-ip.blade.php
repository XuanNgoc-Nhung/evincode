@extends("admin.layout.app")
@section("title")
    <title>Admin - Cấu hình danh sách truy cập</title>
@endsection
@section("content")
    <div>
        <div id="app">
            <admin-list-ip/>
        </div>
    </div>
@endsection
@section("js_location")
    <script src="{{asset('js/admin-list-ip.js?t='.Carbon\Carbon::now()->timestamp)}}"></script>
@endsection
