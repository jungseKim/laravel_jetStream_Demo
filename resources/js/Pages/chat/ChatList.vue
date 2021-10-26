<template >
     <app-layout title="chatList">
            
       <!-- <div class="container mx-auto p-8">
       <div class="grid grid-cols-3 gap-4">
        <div class="border-solid border-4 border-light-blue-500 bg-purple-600 bg-opacity-25 text-center h-20"
        v-for="item in list" :key="item.id">
        <Link class="align-text-middle"  :href="route('chat.room',[roomId=item.id])"> {{item.title}}</Link>
        </div>
      </div>
      </div> -->
      <div v-for="user in users" :key="user.id" @click="invitation(user.id)">
               <user-list :user="user"/>
      </div>
    
       </app-layout>
</template>

<script>
 import AppLayout from '@/Layouts/AppLayout.vue'
 import { Link } from '@inertiajs/inertia-vue3';
 import { Inertia } from '@inertiajs/inertia'
 import userList from './userList.vue'
import { useForm } from '@inertiajs/inertia-vue3'
export default{
       props:['currentUser'],
    components:{
      AppLayout,
      Link,
      userList
    },
       data(){
        return{
               users:null,
               channel:null
        }      
       },
  created(){
      this.channel=window.Echo.join('presence-video-chat')
        .here((users) => {
       this.users=users
        console.log(users)
    })
    .joining((user) => {
        this.users.push(user)
    })
    .leaving((user) => {
        this.users.splice(this.users.indexOf(user), 1);
    })
    .listenForWhisper('messageReady'+this.currentUser.id,(e)=>{
           alert(`${e.user.name}님이 초대하셨습니다`)
       //     if(confirm(`${e.user.name}님이 초대하셨습니다`)){
              // this.channel.whisper('gochat'+e.user.id,
              //   {user:this.currentUser});
              //   const forom=useForm();
              //   forom.post()
       //     }
    }).listenForWhisper('gochat',{

    });
  },
  beforeUnmount(){
        window.Echo.leave('presence-video-chat');
  },
  methods:{
         invitation(id){
                this.channel.whisper('messageReady'+id,
                {user:this.currentUser});
                console.log(id)
         }
  }
}
</script>
