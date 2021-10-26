<template>
 <app-layout title="show">
   <div class="justify-center w-4/5 border-t border-b pt-16 grid grid-cols-2 gap-8">
		<div class="flex flex-col justify-center">
			<div class="flex flex-col w-full object-cover h-4/6 justify-items-start border rounded-lg overflow-hidden"
				style="min-heigth:320px">
				<img class="w-full h-full object-cover" :src='"/storage/image/"+post.image' alt='nike shoes' >
            </div>
			</div>
              <div class="flex flex-col">
                     <div class="flex flex-col gap-4">
                            <h1 class="capitalize text-4xl font-extrabold">{{post.title}}</h1>
                            <h2 class="text-3xl">{{post.user.name}}</h2>
                            <p class="text-lg text-gray-500	">{{post.content}}</p>
                            <div class="flex items-center gap-4 my-6 cursor-pointer ">
                            <div class="bg-blue-600 px-5 py-3 text-white rounded-lg w-2/4 text-center" @click="edit">수정</div>
                            <update-modal :show="show"  @close="close" :post="post"></update-modal>
                            <div class="bg-red-600 px-5 py-3 text-white rounded-lg w-2/4 text-center" @click="del" >삭제</div>
                          
                            </div>
                     </div>
              </div>
       </div>
      </app-layout>
</template>

<script>
 import AppLayout from '@/Layouts/AppLayout.vue'
import UpdateModal from './updateModal.vue'
export default {
       props:['post']
       ,
       components:{
              AppLayout,
              UpdateModal
       },
       data(){
              return{
                     show:null
              }
       }
       ,
       methods:{
              edit(){
                     this.show=true;                     
              },
              close(){
                     this.show=false;
                     
              }
       }
       ,
       mounted(){
              console.log(this.post.image)
       }
}
</script>