<template>
    <div class="container">
        <p>Welcome to dashboard!</p>

    </div>
</template>

<script>
    import axios from 'axios';
    axios.defaults.headers.common["Authorization"] = "Bearer " + sessionStorage.getItem('accessToken');
    export default {
        data() {
        },
        methods:{
            logoutPost(){
                let vm = this;
                axios.post('/api/auth/logout', vm.loginDetails)
                    .then(function (response) {
                        if(response.status == 204)
                        {
                            sessionStorage.removeItem('accessToken');
                            this.$router.replace('/login')
                        }
                    });
            }
        },
        async mounted() {
            try {
                await axios.get('/api/user');
            } catch (error) {
                if (error.response.status == 401) {
                    this.$router.replace('/login')
                }
            }
        },
    }
</script>

<style scoped>

</style>
