<template>
    <div class="grid grid-cols-3 gap-4">
        <div v-for="item in list" :key="item.id">
        <item :item="item" @click="showItem(item)"/>
    </div>
    </div>
</template>

<script>
import Item from '@/Pages/Post/Item.vue';
import axios from 'axios';
    export default {
        components: {
            Item  
        },
        data(){
            return{
                list:null
            }
        }
        ,
        mounted(){
            axios.get('index').then((res)=>{
                this.list=res.data
            })
        },
        methods:{
            showItem(item){
                this.$inertia.get('post/'+item.id+"/show")
            }
        }
    }
</script>
