<template>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="card-title">Danh sách tài khoản</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="datatable table-bordered table hover-table">
                            <thead class="thead-light">
                            <tr>
                                <th>STT</th>
                                <th>Tài khoản</th>
                                <th>Trạng thái</th>
                                <th>Vai trò</th>
                                <th>Thời gian đăng ký</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody v-if="list_data&&list_data.length">
                            <tr v-for="(user,index) in list_data" :key="index">
                                <td class="text-center">{{ index + 1 }}</td>
                                <td>{{ user.phone }}</td>
                                <td>{{ user.status == 1 ? 'Đã duyệt' : 'Chưa duyệt' }}</td>
                                <td>{{ user.role == 1 ? 'admin' : 'Người dùng' }}</td>
                                <td class="text-center">{{ user.updated_at }}</td>
                                <td class="text-center">
                                    <el-button :disabled="user.role==1" v-if="user.status==1" size="mini" type="warning"
                                               @click.prevent="updateStatusUser(user.phone,0)">Chặn
                                    </el-button>
                                    <el-button :disabled="user.role==1"  v-else size="mini" type="success"
                                               @click.prevent="updateStatusUser(user.phone,1)">Duyệt
                                    </el-button>
                                    <el-button :disabled="user.role==1"  size="mini" type="danger" @click.prevent="confirmDel(user.name)">Xoá
                                    </el-button>
                                </td>
                            </tr>
                            </tbody>
                            <tbody v-else>
                            <tr>
                                <td colspan="7" class="text-center">
                                    <p>Không có dữ liệu</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <PhanTrang v-show="paging.total>0" :tongbanghi="paging.total"
                                   :batdau="trangbatdau"
                                   @pageChange="layLai($event)">
                        </PhanTrang>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import rest_api from "../../api/rest_api";
import Vue from 'vue';
import ElementUI from 'element-ui';
import PhanTrang from "../Ui/phanTrang";
import {
    Icon
} from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(ElementUI);
Vue.use(Icon);
export default {
    components: {
        PhanTrang
    },
    data() {
        return {
            list_data: [],
            loading: {
                status: false,
                text: 'Loading...'
            },
            show_add: false,
            dataAdd: {
                ip: '',
                name: ''
            },
            trangbatdau:false,
            paging: {
                total: 0,
                start:0,
                limit:10,
                currentPage:1
            },
            rules: {
                // name: [{
                //     required: true,
                //     message: 'Chưa nhập địa chỉ ip',
                //     trigger: ['blur', 'change']
                // }],
                ip: [{
                    required: true,
                    message: 'Chưa nhập địa chỉ ip',
                    trigger: ['blur', 'change']
                }],
            }
        }
    },
    mounted() {
        console.log('Mounted Ipconfig...')
        this.getListUser()
    },
    methods: {
        layLai(e){
            console.log('onPagingClick')
            this.paging.start = e.start;
            this.paging.limit = e.limit;
            this.paging.currentPage = e.currentPage;
            this.getListUser()
        },
        confirmDel(name) {
            this.$confirm('Xác nhận xoá tài khoản này kèm theo các dữ liệu liên quan?', 'Thông báo', {
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Hủy',
            })
                .then(_ => {
                    let params = {
                        userName: name,
                    }
                    console.log(params)
                    var url = '/delete-user'
                    this.loading.status = true;
                    this.loading.text = 'Loading...'
                    rest_api.post(url, params).then(
                        response => {
                            if (response.data.rc == 0) {
                                console.log('Danh sách ip trả về')
                                console.log(response)
                                this.getListUser()
                                this.thongBao('success', 'Xoá dữ liệu thành công')
                            } else {
                                this.thongBao('error', response.data.rd)
                            }
                            this.loading.status = false;
                        }
                    ).catch((e) => {
                    })
                })
                .catch(_ => {
                });
        },
        updateStatusUser(userName, status) {
            this.$confirm('Xác nhận thay đổi trạng thái ip?', 'Thông báo', {
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Hủy',
            })
                .then(_ => {
                    let params = {
                        userName: userName,
                        status: status
                    }
                    console.log(params)
                    var url = '/update-status-user'
                    this.loading.status = true;
                    this.loading.text = 'Loading...'
                    rest_api.post(url, params).then(
                        response => {
                            if (response.data.rc == 0) {
                                console.log('Danh sách ip trả về')
                                console.log(response)
                                this.show_add = false;
                                this.getListUser()
                                this.thongBao('success', 'Thay đổi trạng thái thành công')
                            } else {
                                this.thongBao('error', response.data.rd)
                            }
                            this.loading.status = false;
                        }
                    ).catch((e) => {
                    })
                })
                .catch(_ => {
                });
        },
        validateForm(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.$confirm(
                        'Xác nhận thêm mới? Thiết bị có địa chỉ ip trên sẽ được phép sử dụng tool?',
                        'Thông báo', {
                            confirmButtonText: 'Đồng ý',
                            cancelButtonText: 'Hủy',
                        })
                        .then(_ => {
                            this.addIp();
                        })
                        .catch(_ => {
                        });
                } else {
                    this.thongBao('error', 'Vui lòng bổ sung các trường thông tin bắt buộc')
                }
            })
        },
        getListUser() {
            let params = {
                start:this.paging.start,
                limit:this.paging.limit,
                userName:''
            }
            var url = '/get-list-user'
            this.loading.status = true;
            this.loading.text = 'Loading...'
            this.list_data = [];
            rest_api.post(url, params).then(
                response => {
                    if (response.data.rc == 0) {
                        this.list_data = response.data.data;
                        this.paging.total = response.data.total;
                        this.thongBao('success', 'Lấy dữ liệu thành công')
                    } else {
                        this.thongBao('error', response.data.rd)
                    }
                    this.loading.status = false;
                }
            ).catch((e) => {
            })
        },
        thongBao(typeNoty, msgNoty) {
            let msg = "";
            let cl = "";
            if (msgNoty) {
                msg = msgNoty;
            }
            let type = "success";
            if (typeNoty) {
                type = typeNoty
            }
            if (type == "success") {
                cl = "dts-noty-success"
            }
            if (type == "warning") {
                cl = "dts-noty-warning"
            }
            if (type == "error") {
                cl = "dts-noty-error"
            }
            if (type == "info") {
                cl = "dts-noty-info"
            }
            this.$message({
                customClass: cl,
                showClose: true,
                message: msg,
                type: type,
                duration: 3000
            });
        },
    }
}

</script>
<style scoped="scoped">
label {
    margin-bottom: 0;
}

td {
    text-align: left;
}

</style>
