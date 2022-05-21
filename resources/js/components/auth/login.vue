<template>
    <div class="container" style="margin-top: 100px">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form class="form-horizontal" role="form">
                             <div class="form-group" :class="{'has-error' : errorsEmail}">
                                 <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                 <div class="col-md-6">
                                     <input id="email" type="email" class="form-control" name="email" v-model="loginDetails.email" required autofocus>

                                     <span v-if="errorsEmail" class="help-block">
                                     </span>
                                 </div>
                             </div>
                            <div class="form-group" :class="{'has-error' : errorsPassword}">
                                <label for="password" class="col-md-4 control-label">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" v-model="loginDetails.password" name="password" required>
                                    <span v-if="errorsPassword" class="help-block">
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" @click.prevent="loginPost" class="btn btn-primary">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        data(){
            return{
                loginDetails:{
                    email:'',
                    password:'',
                    remember:true
                },
                errorsEmail: false,
                errorsPassword: false,
                emailError:null,
                passwordError:null
            }
        },
        methods:{
            loginPost(){
                let vm = this;
                axios.post('/api/auth/login', vm.loginDetails)
                    .then(function (response) {
                        sessionStorage.setItem('accessToken', response.data.token);
                        axios.defaults.headers.common["Authorization"] = "Bearer " + response.data.token;
                        window.location.replace("/");
                    })
                    .catch(function (error) {
                        var errors = error.response
                        if(errors.statusText === 'Unprocessable Entity'){
                            if(errors.data){
                                if(errors.data.email){
                                    vm.errorsEmail = true
                                    vm.emailError = _.isArray(errors.data.email) ? errors.data.email[0]: errors.data.email
                                }
                                if(errors.data.password){
                                    vm.errorsPassword = true
                                    vm.passwordError = _.isArray(errors.data.password) ? errors.data.password[0] : errors.data.password
                                }
                            }
                        }
                    });
            }
        },
        async mounted() {
            try {
                const response = await axios.get('/api/user');
                if(response.status == 200)
                {
                    this.$router.replace('/')
                }
            } catch (error) {
                if (error.response.status == 401) {
                    this.$router.replace('/login')
                }
            }
        },
    }
</script>
