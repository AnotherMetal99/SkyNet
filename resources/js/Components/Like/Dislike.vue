<template>
    <div class="flex items-center">
        <span>{{ item.disliked }}</span>
        <form @submit.prevent="method">
            <button type="submit" class="focus:outline-none">
                <p name="thumbs-down" class=" w-3 h-3 ml-1 fill-current hover:text-red-600">👎</p>
            </button>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['item', 'method']
    }
</script>