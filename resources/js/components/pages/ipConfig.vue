<template>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="card-title">Danh sách địa chỉ ip có thể truy cập tool</h5>
                        </div>
                        <div class="col-6 text-right">
                            <el-button size="mini" type="primary" @click.prevent="showAdd()">Thêm mới</el-button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="datatable table-bordered table hover-table">
                            <thead class="thead-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Người dùng</th>
                                    <th>Địa chỉ ip</th>
                                    <th>Trạng thái</th>
                                    <th>Truy cập gần nhất</th>
                                    <th>Số lượt truy cập</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody v-if="list_data&&list_data.length">
                                <tr v-for="(ip,index) in list_data" :key="index">
                                    <td class="text-center">{{index+1}}</td>
                                    <td>{{ip.name}}</td>
                                    <td>{{ip.ip}}</td>
                                    <td>{{ip.status==1?'Được phép sử dụng':'Không được phép sử dụng'}}</td>
                                    <td class="text-center">{{ip.updated_at}}</td>
                                    <td class="text-center">{{ip.count}}</td>
                                    <td class="text-center">
                                        <el-button v-if="ip.status==1" size="mini" type="warning"
                                            @click.prevent="updateStatus(ip.ip,0)">Chặn dùng</el-button>
                                        <el-button v-else size="mini" type="success"
                                            @click.prevent="updateStatus(ip.ip,1)">Kích hoạt</el-button>
                                        <el-button size="mini" type="danger" @click.prevent="confirmDel(ip.ip)">Xoá
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
        <div class="col-12">
            <el-dialog title="Thêm mới cấu hình" :visible.sync="show_add" custom-class="minWidth375" width="30%"
                :before-close="handleClose">
                <el-form ref="addIp" :model="dataAdd" :rules="rules" style="width: 100%;">
                    <el-row :gutter="24">
                        <el-col :span="24">
                            <el-form-item prop="name">
                                <label>Tên người dùng</label>
                                <el-input placeholder="Nhập tên người dùng" v-model="dataAdd.name"></el-input>
                            </el-form-item>
                        </el-col>
                        <el-col :span="24">
                            <el-form-item prop="ip">
                                <label>Địa chỉ ip <span class="text-danger">*</span></label>
                                <el-input placeholder="Nhập địa chỉ ip" v-model="dataAdd.ip"></el-input>
                            </el-form-item>
                        </el-col>
                    </el-row>
                </el-form>
                <span slot="footer" class="dialog-footer">
                    <el-button size="mini" type="danger" @click="show_add = false">Đóng</el-button>
                    <el-button size="mini" type="primary" @click.prevent="validateForm('addIp')">Thêm mới</el-button>
                </span>
            </el-dialog>
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
                },

                trangbatdau:false,
                paging: {
                    total: 0,
                    start:0,
                    limit:10,
                    currentPage:1
                },
            }
        },
        mounted() {
            console.log('Mounted Ipconfig...')
            this.getListIpConfig()
        },
        methods: {
            layLai(e){
                console.log('onPagingClick')
                this.paging.start = e.start;
                this.paging.limit = e.limit;
                this.paging.currentPage = e.currentPage;
                this.getListIpConfig()
            },
            confirmDel(ip) {
                this.$confirm('Xác nhận xoá địa chỉ ip này?', 'Thông báo', {
                        confirmButtonText: 'Đồng ý',
                        cancelButtonText: 'Hủy',
                    })
                    .then(_ => {
                        let params = {
                            ip: ip,
                        }
                        console.log(params)
                        var url = '/delete-ip'
                        this.loading.status = true;
                        this.loading.text = 'Loading...'
                        rest_api.post(url, params).then(
                            response => {
                                if (response.data.rc == 0) {
                                    console.log('Danh sách ip trả về')
                                    console.log(response)
                                    this.getListIpConfig()
                                    this.thongBao('success', 'Xoá dữ liệu thành công')
                                } else {
                                    this.thongBao('error', response.data.rd)
                                }
                                this.loading.status = false;
                            }
                        ).catch((e) => {})
                    })
                    .catch(_ => {});
            },
            updateStatus(ip, status) {
                this.$confirm('Xác nhận thay đổi trạng thái ip?', 'Thông báo', {
                        confirmButtonText: 'Đồng ý',
                        cancelButtonText: 'Hủy',
                    })
                    .then(_ => {
                        let params = {
                            ip: ip,
                            status: status
                        }
                        console.log(params)
                        var url = '/update-ip'
                        this.loading.status = true;
                        this.loading.text = 'Loading...'
                        rest_api.post(url, params).then(
                            response => {
                                if (response.data.rc == 0) {
                                    console.log('Danh sách ip trả về')
                                    console.log(response)
                                    this.show_add = false;
                                    this.getListIpConfig()
                                    this.thongBao('success', 'Thay đổi trạng thái thành công')
                                } else {
                                    this.thongBao('error', response.data.rd)
                                }
                                this.loading.status = false;
                            }
                        ).catch((e) => {})
                    })
                    .catch(_ => {});
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
                            .catch(_ => {});
                    } else {
                        this.thongBao('error', 'Vui lòng bổ sung các trường thông tin bắt buộc')
                    }
                })
            },
            addIp() {
                let params = {
                    ip: this.dataAdd.ip,
                    name: this.dataAdd.name
                }
                console.log(params)
                var url = '/add-ip'
                this.loading.status = true;
                this.loading.text = 'Loading...'
                rest_api.post(url, params).then(
                    response => {
                        if (response.data.rc == 0) {
                            console.log('Danh sách ip trả về')
                            console.log(response)
                            this.show_add = false;
                            this.getListIpConfig()
                            this.thongBao('success', 'Thêm địa chỉ ip thành công')
                        } else {
                            this.thongBao('error', response.data.rd)
                        }
                        this.loading.status = false;
                    }
                ).catch((e) => {})
            },
            handleClose() {
                this.show_add = false;
            },
            showAdd() {
                this.show_add = true;
            },
            getListIpConfig() {
                let params = {
                    start: this.paging.start,
                    limit: this.paging.limit,
                    userName:''
                }
                var url = '/get-list-ip'
                this.loading.status = true;
                this.loading.text = 'Loading...'
                this.list_data = [];
                rest_api.post(url, params).then(
                    response => {
                        if (response.data.rc == 0) {
                            this.list_data = response.data.data;
                            this.paging.total = response.data.total
                            this.thongBao('success', 'Lấy dữ liệu thành công')
                        } else {
                            this.thongBao('error', response.data.rd)
                        }
                        this.loading.status = false;
                    }
                ).catch((e) => {})
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
