<template>
<div class="py-10 h-screen bg-gray-300 px-2">
     <h2 class="text-3xl">comment</h2>
     <div class="relative">
           <p class="text-red-400">{{$page.props.errors.content}}</p>
    <input type="text" v-model="content"
      class="w-3/4 h-12 ml-4 rounded focus:outline-none px-3 focus:shadow-md" placeholder="comment">
     <button @click="send"
      class="p-2 pl-5 pr-5 bg-blue-500 text-gray-100 text-lg rounded-lg focus:border-4 border-blue-300">작성</button>
     </div>
       <div class="md:flex">
            <div class="w-full p-4">
              <div  v-for="comment in commnets" :key="comment.id">
                 <coomment-item :comment="comment" v-on:commentDel="godel(comment.id)"/>
              </div>
            </div>
        </div>

</div>
</template>

<script>
import axios from 'axios';
import CoommentItem from './CoommentItem.vue';
export default {
       components:{
              CoommentItem
       },
       props:['postId']
       ,
       data(){
           return{
               content:null,
               commnets:null
           }
       },
       mounted(){
         this.commentGet()
       }
        ,
    methods:{
        godel(c){
            console.log(c);
        },
        send(){
                this.$inertia.post('/comment/'+this.postId,{
                        content:this.content},
                     {onSuccess:(p)=> this.commentGet()}   )
                }
    ,
        commentGet(){
            axios.get('/comment/'+this.postId).then((res)=>{
                        this.commnets=res.data;
                    }).catch((err)=>{
                        console.log(err.data)
                    })
        }
}


}
</script>
