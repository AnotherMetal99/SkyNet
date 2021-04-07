<template>
    <page-layout>
        <template #title>
            <div class="flex  flex-col sm:justify-between sm:flex-row items-center">
              <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                  <inertia-link :href="route('members.index')" class="capitalize underline">
                     Members
                  </inertia-link>
              </h2>
              <span class="text-gray-800 leading-tight text-lg capitalize mt-5 sm:mt-0">
                 Visit your
                 <inertia-link :href="route('members.index')" class="underline hover:text-green-500">
                     Friends
                  </inertia-link>
              </span>
            </div>
        </template>

        <div class="sm:flex sm:flex-wrap">
           <inertia-link :href="route('profile.show', member.username)" class="sm:1/2"
           v-for="(member,index) in members" :key="index">
             <div class="flex items-center bg-gray-50 px-2 py-3 border-1 border-gray-500 mt-5 hover:bg-gray-400 hover:text-blue-800">
                <div class="flex flex-shrink-0">
                   <img :src="member.profile_photo_url" :alt="member.username" class="h-8 w-8 rounde-full object-cover">
                </div>
                <div class="flex flex-grow overflow-hidden">
                   <span class="text-lg ml-3">
                      {{member.username}}
                   </span>
                </div>
             </div>
           </inertia-link>
        </div>

        
    </page-layout>
</template>

<script>
    import PageLayout from '@/Layouts/PageLayout'
    export default {
       props: ['members'],
        components: {
            PageLayout,
        },
    }
</script>

