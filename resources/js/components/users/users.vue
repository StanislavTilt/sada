<template>
    <div class="container">
        <ul class="list-group">
            <button v-for="user in users" type="button" class="list-group-item list-group-item-action">{{ user.name }}</button>
        </ul>
        <br>
        <pagionation :total="total" :item="elementsPage" :total-pages="totalPages" @page-changed="loadUsers"/>
    </div>

</template>

<script>
    import axios from 'axios';
    import Pagionation from './pagination.vue';
    axios.defaults.headers.common["Authorization"] = "Bearer " + sessionStorage.getItem('accessToken');
    export default {
        data() {
            return{
                token:sessionStorage.getItem('accessToken'),
                page:1,
                total:0,
                totalPages:0,
                elementsPage:0,
                users:null,
            }
        },
        components: {Pagionation},
        methods:{
            async loadUsers(pageNumber)
            {
                const response = await axios.get(`api/users?page=${pageNumber}`);
                this.users = response.data.data;
                this.total = response.data.meta.total;
                this.totalPages = response.data.meta.last_page;
                this.elementsPage = response.data.meta.per_page;
                console.log(this.total);
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
        created() {
            this.loadUsers(this.page);
        }
    }
</script>

<style scoped>

</style>
