<template>
    <div>
        <div v-for="(comment, index) in comments" :key="index">
            <comment-item :comment="comment"></comment-item>
        </div>
    </div>
</template>

<script>
    import CommentItem from '@/Components/CommentItem'
    export default {
        props: ['comments'],
        components: {
            CommentItem,
        }
    }
</script>