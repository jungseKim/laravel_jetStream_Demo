<template>
     <div >

         <div class="flex justify-between items-center bg-white mt-2 p-2 hover:shadow-lg rounded cursor-pointer transition">
                        <div class="flex ml-2">
                            <img src="https://i.imgur.com/aq39RMA.jpg" width="40" height="40" class="rounded-full">
                            <!-- <img v-if="post.image" class="w-full h-full object-cover" :src='"/storage/image/"+post.image' alt='nike shoes' >
                <img v-else class="w-full h-full object-cover" src='https://thumbs.dreamstime.com/b/no-image-available-icon-flat-vector-no-image-available-icon-flat-vector-illustration-132482953.jpg' alt='nike shoes' > -->
                            <div class="flex flex-col ml-2"> <span class="font-medium text-black">{{comment.content}}</span> <span class="text-sm text-gray-400 truncate w-32">{{comment.user.name}}</span> </div>
                        </div>
                        <div class="flex flex-col items-center"> <span class="text-gray-300">{{comment.create_at}}</span> <i class="fa fa-star text-green-400"></i> </div>
                  <div class="grid grid-cols-1 ">
                         <button @click="$emit('commentDel')" class="m-1 bg-transparent border-2 border-red-500 text-red-500  rounded-md hover:bg-red-500 hover:text-gray-100 focus:border-4 focus:border-red-300">delete</button>
                          <button class="m-1 bg-transparent border-2 border-green-500 text-green-500  rounded-md hover:bg-red-500 hover:text-gray-100 focus:border-4 focus:border-green-300">edit</button>
                    </div>
                    </div>

     </div>
</template>

<script>
export default {
    props:['comment']
    ,
    methods:{

    }
}
</script>
