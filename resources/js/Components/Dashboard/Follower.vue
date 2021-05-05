<template>
    <div class="flex flex-col">
        <h3 class="font-semibold text-lg text-gray-800 leading-tight mt-5">Рекомендации:</h3>
        <div class="flex mb-2 pb-2">
            <div v-for="user in followers" :key="user.id" class="w-1/4">
                <inertia-link :href="route('profiles.show', user.username)" class="sm:w-1/2">
                    <div class="flex flex-col items-center px-1 py-2 border-gray-400 mt-2 hover:bg-gray-100 rounded-lg">
                        <img class="h-8 w-8 rounded-full object-cover " :src="user.profile_photo_url" :alt="user.username" :title="user.username" />
                    </div>
                </inertia-link>
            </div>
        </div>
    </div>
</template>

<script>

export default ({
  props:['followers']
})
</script>
