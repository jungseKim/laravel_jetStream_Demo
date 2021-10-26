<template >
       <div>
              <div class="flex flex-col ml-2">
                    <label class="text-gray-800">hellow </label>
                    <p class="text-gray-500 ">{{ user.name }}
                           </p>
                </div>
       </div>
</template>

<script>
export default {
       props:['user']
       ,

}
</script>