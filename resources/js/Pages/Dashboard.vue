<template>
    <page-layout>
        <template #title>
            <div class="flex justify-between items-center w-full">
              <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                  <img :src="$page.props.user.profile_photo_url" alt="$page.props.user.username" class="h-8 w-8 rounded-full object-cover">
                  <span class="capitalize ml-3">Dashboard</span> 
              </h2>
            </div>
        </template>

        
    </page-layout>
</template>

<script>
    import PageLayout from '@/Layouts/PageLayout'
   

    export default {
        components: {
            PageLayout,
        },
    }
</script>
