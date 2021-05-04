<template>
    <page-layout>
        <template #title>
            <div class="flex flex-col">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    <span class="capitalize underline">Chat Rooms</span>
                </h2>
                <table class="mt-5">
                    <thead>
                        <tr class="border-b border-gray-800">
                            <th class="text-left pl-3">Room Name:</th>
                            <th>Active Members:</th>
                            <th class="text-right pr-3">Join</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b bg-gray-50 h-10 hover:bg-gray-400 hover:text-blue-800 transition ease-in-out duration-150" v-for="(chat, index) in chats" :key="index">
                            <td class="text-left pl-3 py-3">{{ chat.name }}</td>
                            <td class="text-center py-3">{{ chat.active }}</td>
                            <td class="text-right pr-3 py-3">
                                <send-button :href="route('chat-chats.show', chat.slug)" class="text-xs">Join</send-button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </template>
    </page-layout>
</template>

<script>
    import PageLayout from '@/Layouts/PageLayout'
    import SendButton from '@/Components/Chat/SendButton'
    export default {
        props: ['chats'],
        components: {
            SendButton,
            PageLayout,
        }
    }
</script>