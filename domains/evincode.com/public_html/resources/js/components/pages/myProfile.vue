<template>

    <div v-loading.fullscreen.lock="loading.status" :element-loading-text="loading.text"
         element-loading-spinner="el-icon-loading" element-loading-background="rgba(0, 0, 0, 0.8)">
        <div class="content container-fluid ">

            <!-- Profile Information -->
            <div class="row">
                <div class="col-12">
                    <div class="setting-info profile-info">
                        <h4>Thông tin người dùng</h4>
                        <div class="row mb-2">
<!--                            <div class="col-md-6">-->
<!--                                <label class="">Họ & tên</label>-->
<!--                                <input disabled type="text" v-model="info.name" placeholder="Email hoặc số điện thoại"-->
<!--                                       class="form-control">-->
<!--                            </div>-->
                            <div class="col-md-6">
                                <label class="">Tên đăng nhập</label>
                                <el-input disabled type="text" v-model="info.phone" placeholder="Email hoặc số điện thoại" />
                            </div>
                            <div class="col-md-6">
                                <label class="">Tài khoản</label>
                                <el-input disabled type="text" value="2.000.000đ" placeholder="Email hoặc số điện thoại"
                                       />
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="">Cấp bậc</label>
                                <el-input disabled type="text" value="Thành viên Bạc" placeholder="Email hoặc số điện thoại"/>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="">Địa chỉ ip cá nhân</label>
                                <div>
                                    <el-input placeholder="Nhập địa chỉ ip" v-model="ipHost.ip">
                                        <template slot="append">
                                            <el-tooltip effect="dark" content="Lấy thông tin địa chỉ ip cá nhân" placement="top">
                                            <el-button type="danger" @click.prvent="getMyIp()">
                                                <i class="el-icon-refresh"></i></el-button>
                                            </el-tooltip>
                                        </template>
                                    </el-input>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row mt-auto">
                <div class="col-md-12">
                    <div class="text-center">
                        <el-button size="mini" type="primary" @click.prevent="updateIp">Lưu lại thông tin</el-button>
<!--                        <button type="submit" class="btn btn-primary btn-sm" @click.prevent="updateIp()">Lưu lại</button>-->
                    </div>
                </div>
            </div>
            <!-- /Profile Information -->
        </div>
    </div>
</template>

<script>
import rest_api from "../../api/rest_api";
import Vue from 'vue';
import ElementUI from 'element-ui';
import {Icon} from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(ElementUI);
Vue.use(Icon);
export default {
    props: ['info', 'ip'],
    data() {
        return {
            loading: {
                status: false,
                text: 'Loading...'
            },
            ipHost: {
                ip: ''
            }
        }
    },
    mounted() {
        console.log('Mounted thông tin tài khoản...')
        console.log(this.info)
        console.log(this.ip)
        if (this.ip) {
            this.ipHost = JSON.parse(JSON.stringify(this.ip))
        }
    },
    methods: {
        getMyIp() {
            this.loading.status = true;
            this.loading.text = 'Đang lấy thông tin địa chỉ ip.'
            fetch('https://api.ipify.org?format=json')
                .then(x => x.json())
                .then(({ ip }) => {
                    if(ip){
                        this.ipHost.ip =ip;
                        this.thongBao('success','Địa chỉ ip đã được lấy về. Vui lòng cập nhật.')
                    }
                    else{
                        this.thongBao('error','Không lấy được địa chỉ ip của thiết bị. Vui lòng thử lại')
                    }
                    this.loading.status = false
                });
        },
        updateIp() {
            if (!this.ipHost.ip) {
                this.thongBao('error', 'Vui lòng bổ sung địa chỉ ip.')
                return;
            }
            let params = {
                'ip': this.ipHost.ip,
                'user': this.info.phone
            }
            console.log(params)
            var url = '/update-my-ip'
            this.loading.status = true;
            this.loading.text = 'Đang cập nhật...'
            rest_api.post(url, params).then(
                response => {
                    console.log('Đăng ký trả về:')
                    console.log(response.data)
                    if (response.data.rc == 0) {
                        this.thongBao('success', response.data.rd)
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
.el-input{
    color: black !important;
}
</style>
