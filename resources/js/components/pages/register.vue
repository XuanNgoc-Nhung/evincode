<template>
        <div class="login-wrapper">
            <div class="loginbox">
                <div class="img-logo">
                    <img src="user/assets/img/logo.png" class="img-fluid" alt="Logo">
                </div>
                <h3>Đăng ký thành viên</h3>
                    <div class="form-group">
                        <label class="">Tên đăng nhập</label>
                        <input type="text" v-model="dataRegister.phone" placeholder="Email hoặc số điện thoại" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="focus-label">Mật khẩu</label>
                        <input type="password" v-model="dataRegister.password"class="form-control ">
                    </div>
                    <div class="form-group">
                        <label class="focus-label">Nhập lại mật khẩu</label>
                        <input type="password" v-model="dataRegister.rePassword" class="form-control ">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12">
                                <label class="custom_check mr-2 mb-0"> Tôi chấp nhận với các <b>Điều khoản</b> và
                                    <b>Chính sách bảo mật</b>.
                                    <input type="checkbox" v-model="dataRegister.check" name="radio">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary" @click.prevent="checkRegister()" >Đăng ký</button>
                    </div>
                    <div class="dont-have text-left">Bạn đã có tài khoản? <a href="/login">Đăng nhập</a></div>
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
    data() {
        return {
            loading: {
                status: false,
                text: 'Loading...'
            },
            dataRegister: {
                phone: '',
                password: '',
                rePassword: '',
                check: '',
            }
        }
    },
    mounted() {
        console.log('Mounted Login...')
    },
    methods: {
        checkRegister() {
            if(!this.dataRegister.phone){
                this.thongBao('error','Vui lòng bổ sung tên tài khoản.')
                return;
            }
            if(!this.dataRegister.password){
                this.thongBao('error','Vui lòng bổ sung mật khẩu.')
                return;
            }
            if(this.dataRegister.password!=this.dataRegister.rePassword){
                this.thongBao('error','Vui lòng nhập lại đúng mật khẩu.')
                return;
            }
            if(!this.dataRegister.check){
                this.thongBao('error','Không đồng ý với điều khoản thì đăng ký làm gì?')
                return;
            }
            let params = {
                'phone': this.dataRegister.phone,
                'password': this.dataRegister.password,
            }
            console.log(params)
            var url = '/register'
            this.loading.status = true;
            this.loading.text = 'Đang đăng ký...'
            rest_api.post(url, params).then(
                response => {
                    console.log('Đăng ký trả về:')
                    console.log(response.data)
                    if(response.data.rc==0){
                        this.thongBao('success',response.data.rd)
                    }
                    else {
                        this.thongBao('error',response.data.rd)
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
.pxn-button-login {
    color: #ffffff;
    font-family: 'Encode Sans', sans-serif;
    padding: 7px 16px;
    text-align: center;
    background: #1A9CC6;
    border: unset;
    box-shadow: inset 0 0 0 0 #0071dc;
    border-radius: 4px;
    min-width: 110px;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
    -o-transition: all 0.5s;
    transition: all 0.5s;
    font-weight: 600;
    font-size: 13px;
    line-height: 22px;
}
</style>
