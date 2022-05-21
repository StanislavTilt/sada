<template>
     <div>
         <ul class="pagination">
             <li v-for="p in totalPages" :key="p">
                 <button class="pagination-button"
                         :class="{active: currentPage === p}"
                         @click.prevent="changePage(p)">{{ p }}</button>
             </li>
         </ul>
     </div>
</template>

<script>
    export default {
        name: "pagination",
        props: ['total', 'item', 'totalPages'],
        data() {
            return {
                currentPage: 1
            }
        },
        computed: {

        },
        methods: {
            changePage(pageNumber){
                this.currentPage = pageNumber;
                this.$emit('page-changed', pageNumber);
            }
        }
    }
</script>

<style scoped>
    .pagination-button {
        background-color: white;
        color: #1c1d21;
        border: 1px solid #3b5998;
    }

    .active {
        background-color: #1da1f2;
    }
</style>
