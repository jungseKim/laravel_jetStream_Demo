<template>
  <app-layout title="create">
       <div class="flex justify-center items-center w-full bg-blue-400">
    <div class="w-1/2 bg-white rounded shadow-2xl p-8 m-4">
        <h1 class="block w-full text-center text-gray-800 text-2xl font-bold mb-6">Post Make</h1>
        <p class="text-red-400">{{$page.props.errors.title}}</p>
            <div class="flex flex-col mb-4">
                <label class="mb-2 font-bold text-lg text-gray-900" for="first_name">Title</label>
                <input class="border py-2 px-3 text-grey-800" type="text" name="first_name" id="first_name" v-model="title">
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
            </div>
        </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Inertia } from '@inertiajs/inertia'
import { useForm } from '@inertiajs/inertia-vue3'
    export default{
        components: {
            AppLayout
        },
        data(){
            return{
                title:null,
                image:null,
                content:null
            }
        },
       methods:{
            send(){
                // Inertia.post('/post/store', {
                //     title:this.title,
                //     image:this.image,
                //     content:this.content
                // })

                //  const form = useForm({
                //         title: this.title,
                //         image: this.image,
                //         content:this.content
                //         })
                // form.post('post/store');
                this.$inertia.post('/post/store',{
                        title: this.title,
                        image: this.image,
                        content:this.content
                        })

        }
       }

    }
</script>
