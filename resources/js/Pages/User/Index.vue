<template>
    <page-layout>
        <template #title>
            <div class="flex flex-col items-center sm:flex-row sm:justify-between">
                <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                    <span class="underline">
                        {{ `${$page.props.user.username}'s Friends` }}
                    </span>
                </h2>

                <span class="text-gray-800 leading-tight text-lg capitalize mt-5 sm:mt-0">
                    Browse
                    <inertia-link :href="route('members.index')" class="underline hover:text-green-500">
                        members
                    </inertia-link>
                </span>
            </div>
        </template>
        <div>
            <h3 class="font-semibold text-lg text-gray-800 leading-tight mt-5">
                Friend Requests:
            </h3>
            <div v-if="requests.length <= 0">
                <h3>You have no friend requests.</h3>
            </div>
            <block-folow :items="requests"></block-folow>
        </div>
        <div>
            <h3 class="font-semibold text-lg text-gray-800 leading-tight mt-5">
                Friends:
            </h3>
            <block-folow :items="friends"></block-folow>
        </div>
    </page-layout>
</template>

<script>
    import PageLayout from '@/Layouts/PageLayout'
    import BlockFolow from '@/Components/BlockFolow'
    export default {
        props: ['friends', 'requests'],
        components: {
            PageLayout,
            BlockFolow 
        }
    }
</script>