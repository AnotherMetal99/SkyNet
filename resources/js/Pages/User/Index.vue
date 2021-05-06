<template>
    <page-layout>
        <template #title>
            <div class="flex flex-col items-center sm:flex-row sm:justify-between">
                <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                    <span >
                        {{ `Друзья - ${$page.props.user.username} ` }}
                    </span>
                </h2>

                <span class="text-gray-800 leading-tight text-lg capitalize mt-5 sm:mt-0">
                    Посмотреть 
                    <inertia-link :href="route('members.index')" class="underline hover:text-green-500">
                        рекомендации
                    </inertia-link>
                </span>
            </div>
        </template>
        <div>
            <div class="capitalize ml-4">Друзья: {{`${friends.length}`}}</div> 
            <div class="capitalize ml-4">Подписчики: {{`${requests.length}`}}</div> 
            <h3 class="font-semibold text-lg text-gray-800 leading-tight mt-5">
                Запросы в друзья:
            </h3>
            <div v-if="requests.length <= 0">
                <h3>У вас нет запросов в друзья</h3>
            </div>
            <block-folow :items="requests"></block-folow>
        </div>
        <div>
            <h3 class="font-semibold text-lg text-gray-800 leading-tight mt-5">
                Друзья:
            </h3>
            <block-folow :items="friends"></block-folow>
        </div>
    </page-layout>
</template>

<script>
    import PageLayout from '@/Layouts/PageLayout'
    import BlockFolow from '@/Components//Followers/BlockFolow'
    export default {
        props: ['friends', 'requests'],
        components: {
            PageLayout,
            BlockFolow 
        }
    }
</script>