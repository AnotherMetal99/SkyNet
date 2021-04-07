<template>
    <page-layout>
        <template #title>
            <div class="flex justify-between items-center w-full">
              <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                  <img :src="profile.profile_photo_url" alt="profile.username" class="h-8 w-8 rounded-full object-cover">
                  <span class="capitalize ml-3">{{ `${profile.username}'s Profile` }}</span> 
              </h2>
                <status :profile="profile" :friendsWith="friendsWith" :friendPendingFrom="friendPendingFrom" :friendSentTo="friendSentTo" ></status>
            </div>
        </template>

        
    </page-layout>
</template>

<script>
    import PageLayout from '@/Layouts/PageLayout'
    import Status from '@/Components/Status'
    export default {
       props: ['profile','friendsWith','friendPendingFrom','friendSentTo'],
        components: {
            PageLayout,
            Status,
        },
    }
</script>

