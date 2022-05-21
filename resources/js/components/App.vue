<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Menu test</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">

                    <li v-if="token != null" class="nav-item">
                        <a class="nav-link" href="#">
                            <router-link :to="{ name: 'users' }">Users</router-link>
                        </a>
                    </li>
                    <li v-if="token != null" class="nav-item">
                        <a class="nav-link" href="#">
                            <router-link :to="{ name: 'cropImage' }">Crop Image</router-link>
                        </a>
                    </li>
                </ul>

                <button v-if="token != null" class="btn btn-outline-danger my-2 my-sm-0" type="submit" @click.prevent="logoutPost">Log out</button>

            </div>
        </nav>
        <router-view></router-view>
    </div>
</template>
<script>
    import axios from 'axios'
    axios.defaults.headers.common["Authorization"] = "Bearer " + sessionStorage.getItem('accessToken');
    export default {
        data() {
            return{
                token:sessionStorage.getItem('accessToken')
            }
        },
        methods:{
            logoutPost(){
                axios.post('/api/auth/logout')
                    .then(() => {
                        sessionStorage.removeItem('accessToken');
                        this.$router.replace('/login')
                    });
            }
        },
    }
</script>

<style scoped>

</style>
