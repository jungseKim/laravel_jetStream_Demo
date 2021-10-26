<template>
       <dialog-modal :show="show" >
               <template v-slot:title>
                 <h1 class="block w-full text-center text-gray-800 text-2xl font-bold mb-6">Post edit</h1>
                 <p class="text-red-400">{{$page.props.errors.title}}</p>
                   <div class="flex flex-col mb-4">
                <label class="mb-2 font-bold text-lg text-gray-900" for="first_name" >Title</label>
                <input class="border py-2 px-3 text-grey-800" type="text" name="first_name" id="first_name" v-model="title">
            </div>
               </template>

              <template v-slot:content>
                    <div class="flex flex-col w-full object-cover h-4/6 justify-items-start border rounded-lg overflow-hidden"
				style="min-heigth:320px">
                            <img class=" object-cover" :src='"/storage/image/"+post.image' alt='nike shoes' >
                    </div>
                     <p class="text-red-400">{{$page.props.errors.image}}</p>
                     <div class="flex flex-col mb-4">
                            <label class="mb-2 font-bold text-lg text-gray-900" for="File">File</label>
                            <input class="border py-2 px-3 text-grey-800" type="file" name="file" id="file" @input="image= $event.target.files[0]">
                     </div>
                     <p class="text-red-400">{{$page.props.errors.content}}</p>
                     <div class="flex flex-col mb-4">
                            <label class="mb-2 font-bold text-lg text-gray-900" for="textarea">content</label>
                            <textarea class="border py-2 px-3 text-grey-800" name="textarea" id="textarea" v-model="content"></textarea>
                     </div>
                     <button @click="send" class="block bg-green-400 hover:bg-green-600 text-white uppercase text-lg mx-auto p-4 rounded" >Save</button>
              </template>

       </dialog-modal>
       
</template>

<script>
import DialogModal from'@/Jetstream/DialogModal.vue';
export default {
       props:['post','show'],
       components:{
              DialogModal
       },
       data(){
              return{
                     title:null,
                      image:null,
                     content:null
              }
       }
       ,
       mounted(){
              this.title=this.post.title;
              this.content=this.post.content;
       }
       ,
       methods:{
              send(){
                     this.$inertia.post('/post/'+this.post.id+'/edit',{
                     title: this.title,
                        image: this.image,
                        content:this.content
                        })
                        alert('성공적으로 저장 되었습니다.')
                     this.$emit('close')
              },
              del(){
                     this.$inertia.delete()
              }
       }
}
</script>