<?php

namespace App\Http\Controllers;

use App\IpConfig;
use App\Posts;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function getHome()
    {
        return view('admin.home');
    }

    public function listIp()
    {
        return view('admin.list-ip');
    }
    public function listUser(){
        return view('admin.list-user');
    }
    public function getListProducts(Request $request){
        $req = $request->all();
        $list = Posts::where('name', 'like', '%' . $req['name'] . '%');
        $data = $list->orderBy('created_at', 'DESC')->skip($req['start'])->take($req['limit'])->get();
        if (count($data)) {
            $res = [
                'rc' => '0',
                'data' => $data,
                'total' => Posts::where('name', 'like', '%' . $req['name'] . '%')->count()
            ];
        } else {
            $res = [
                'rc' => '1',
                'rd' => 'Không tìm thấy bản ghi nào'
            ];
        }
        return json_encode($res);
    }
    public function getListUser(Request $request){
        $req = $request->all();
        $list = User::where('name', 'like', '%' . $req['userName'] . '%');
        $data = $list->orderBy('created_at', 'DESC')->skip($req['start'])->take($req['limit'])->get();
        if (count($data)) {
            $res = [
                'rc' => '0',
                'data' => $data,
                'total' => IpConfig::where('name', 'like', '%' . $req['userName'] . '%')->count()
            ];
        } else {
            $res = [
                'rc' => '1',
                'rd' => 'Không tìm thấy bản ghi nào'
            ];
        }
        return json_encode($res);
    }
    public function getListIp(Request $request)
    {
        $req = $request->all();
        $list = IpConfig::where('name', 'like', '%' . $req['userName'] . '%');
        $data = $list->orderBy('created_at', 'DESC')->skip($req['start'])->take($req['limit'])->get();
        if (count($data)) {
            $res = [
                'rc' => '0',
                'data' => $data,
                'total' => IpConfig::where('name', 'like', '%' . $req['userName'] . '%')->count()
            ];
        } else {
            $res = [
                'rc' => '1',
                'rd' => 'Không tìm thấy bản ghi nào'
            ];
        }
        return json_encode($res);
    }
    public function products(){

        return view('admin.list-products');
    }
    public function updateProducts(Request $request){
        $req = $request->all();
        $check = Posts::where('id', $req['id'])->first();
        if($check){
            $check->name = $req['name'];
            $check->price = $req['price'];
            $check->detail = $req['detail'];
            $check->note1 = $req['note1'];
            $check->note2 = $req['note2'];
            $check->note3 = $req['note3'];
            if($request->file('hinhAnh')){
                $hinhAnh =  $request->file('hinhAnh');
                $filePathHinhAnh = '/products/' . uniqid() . '.' . $hinhAnh->extension();
                $hinhAnh->move(public_path('products'), $filePathHinhAnh);
                $check->image = $filePathHinhAnh;
            }
            $check->save();
            $res = [
                'rc' => 0,
                'rd' => 'Chỉnh sửa sản phẩm thành công.',
                'data'=>$check
            ];
            return json_encode($res);
        }else{
            $res = [
                'rc' => -1,
                'rd' => 'Không tìm thấy bản ghi tương ứng.',
            ];
            return json_encode($res);
        }
    }
    public function addProducts(Request $request){
        $req = $request->all();
        $hinhAnh =  $request->file('hinhAnh');
        $filePathHinhAnh = '/products/' . uniqid() . '.' . $hinhAnh->extension();
        $hinhAnh->move(public_path('products'), $filePathHinhAnh);
        $dataCreat = Posts::create([
            'name' => $req['name'],
            'note1' => $req['note1'],
            'note2' => $req['note2'],
            'note3' => $req['note3'],
            'detail' => $req['detail'],
            'price' => $req['price'],
            'image' => $filePathHinhAnh,
        ]);
        $res = [
            'rc' => 0,
            'rd' => 'Thêm sản phẩm thành công.',
            'data'=>$dataCreat
        ];
        return json_encode($res);
    }
    public function addIp(Request $request)
    {
        $name = 'Không xác định';
        $ip = $request->ip;
        if ($request->name) {
            $name = $request->name;
        }
        $check = IpConfig::where('ip', $ip)->get();
        if (count($check)) {
            $res = [
                'rc' => '-1',
                'rd' => 'Địa chỉ ip này đã tồn tại'
            ];
        } else {
            $config = new IpConfig;
            $config->ip = $ip;
            $config->name = $name;
            $config->status = 1;
            $config->save();
            $res = [
                'rc' => '0',
                'rd' => 'Thêm thành công'
            ];
        }
        return json_encode($res);

    }

    public function updateIp(Request $request)
    {
        $ip = $request->ip;
        $check = IpConfig::where('ip', $ip)->first();
        $check->status = $request->status;
        $check->save();
        $res = [
            'rc' => '0',
            'rd' => 'Cập nhật trạng thái thành công'
        ];
        return json_encode($res);
    }
    public function updateStatusUser(Request $request){
        $req = $request->all();
        $user = User::find($req['id']);
        if($user){
            $user->status = $request->status;
            $user->save();
            $res = [
                'rc' => '0',
                'rd' => 'Cập nhật trạng thái thành công'
            ];
        }else{

            $res = [
                'rc' => '1',
                'rd' => 'Vui lòng thử lại sau ít phút.'
            ];
        }
        return json_encode($res);

    }

    public function deleteIp(Request $request)
    {
        $ip = $request->ip;
        $check = IpConfig::where('ip', $ip)
            ->first();
        $check->delete();
        $res = [
            'rc' => '0',
            'rd' => 'Xoá thành công'
        ];
        return json_encode($res);
    }

    public function deleteProduct(Request $request)
    {
        $id = $request->id;
        $check = Posts::where('id', $id)
            ->first();
        $check->delete();
        $res = [
            'rc' => '0',
            'rd' => 'Xoá thành công'
        ];
        return json_encode($res);
    }
    public function deleteUser(Request $request)
    {
        $req = $request->all();
        $user = User::find($req['id']);
        if($user){
            $user->status = $request->status;
            $user->delete();
            $res = [
                'rc' => '0',
                'rd' => 'Cập nhật trạng thái thành công'
            ];
        }else{

            $res = [
                'rc' => '1',
                'rd' => 'Vui lòng thử lại sau ít phút.'
            ];
        }
        return json_encode($res);
    }
    public function updateInfoUser(Request $request){
        $req = $request->all();
        $user = User::find($req['id']);
        if($user){
            $user->maximum = $req['maximum'];
            $user->ip = $req['ip'];
            $user->save();
            $res = [
                'rc' => '0',
                'rd' => 'Cập nhật trạng thái thành công'
            ];
        }else{

            $res = [
                'rc' => '1',
                'rd' => 'Vui lòng thử lại sau ít phút.'
            ];
        }
        return json_encode($res);
    }
    public function CheckAccess(Request $request){
        $key = env('KEYACCESS');
        $req = $request->all();
        if(isset($req['email'])&&isset($req['activeKey'])&&isset($req['key'])){
            if($req['key']==$key){
                $user = User::where('email',$req['email'])->first();
                if($user){
                    if($user->status==1){
                        if($user->ip==$req['activeKey']){
                            if($user->maximum>$user->count_used){
                                $user->count_used = $user->count_used+1;
                                $user->save();
                                $res = [
                                    'rc'=>'0',
                                    'accept'=>true,
                                    'rd'=>'Có thể truy cập'
                                ];
                            }else{
                                $res = [
                                    'rc'=>'-1',
                                    'accept'=>false,
                                    'rd'=>'Bạn đã hết lượt truy cập'
                                ];
                            }
                        }else{
                            $res = [
                                'rc'=>'-1',
                                'accept'=>false,
                                'rd'=>'Key không hợp lệ'
                            ];
                        }
                    }else{
                        $res = [
                            'rc'=>'-1',
                            'accept'=>false,
                            'rd'=>'Tài khoản chưa được phê duyệt'
                        ];
                    }
                }else{
                    $res = [
                        'rc'=>'-1',
                        'accept'=>false,
                        'rd'=>'Không tìm thấy tài khoản tương ứng với email của bạn'
                    ];
                }
            }else{
                $res = [
                    'rc'=>'-1',
                    'accept'=>false,
                    'rd'=>'Từ khoá không hợp lệ'
                ];
            }
        }else{
            $res = [
                'rc'=>'-1',
                'accept'=>false,
                'rd'=>'Tham số không hợp lệ'
            ];
        }
        return $res;
    }
    public function CheckIpConfig(Request $request){
        Log::error('Check ip onfig');
        $ip = $request->ip;
        Log::error($ip);
        if($ip){
            $config = IpConfig::where('ip',$ip)->where('status',1)->first();
            if($config){
                $config->count = $config->count + 1;
                $config->save();
                $res = [
                    'rc'=>'0',
                    'accept'=>true,
                    'rd'=>'Có thể sử dụng'
                ];
            }else{
                $res = [
                    'rc'=>'-1',
                    'accept'=>false,
                    'rd'=>'Địa chỉ ip chưa được cấu hình'
                ];
            }
        }else{
            $res = [
                'rc'=>'-1',
                'accept'=>false,
                'rd'=>'Địa chỉ ip chưa được cấu hình'
            ];
        }
        return $res;
    }
}
