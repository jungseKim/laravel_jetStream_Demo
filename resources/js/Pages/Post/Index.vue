<template>
<app-layout title="index">
      <div class="relative"> <input type="text"
      class="w-full h-12 rounded focus:outline-none px-3 focus:shadow-md" placeholder="Search...">
       <i class="fa fa-search absolute right-3 top-4 text-gray-300"></i> </div>
    <div class="m-8 grid grid-cols-3 gap-4">
        <div v-for="item in list.data" :key="item.id">
        <item :item="item" @click="showItem(item)"/>
    </div>
    </div>
    <item-link v-if="list.links" :links="list.links" />
    </app-layout>
</template>

<script>
import Item from '@/Pages/Post/Item.vue';
import axios from 'axios';
import ItemLink from './ItemLink.vue'

import AppLayout from '@/Layouts/AppLayout.vue'
    export default {
        components: {
            AppLayout,
            Item,
            ItemLink
        },
        // data(){
        //     return{
        //         list:null
        //     }
        // }
        props:['list']
        ,
        mounted(){
        //     axios.get('index').then((res)=>{
        //         this.list=res.data.data
        //         console.log(res.data)
        //     })
        console.log(this.list)
        },
        methods:{
            showItem(item){
                this.$inertia.get('/post/'+item.id+"/show")
            }
        }
    }
</script>
