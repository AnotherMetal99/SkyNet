<template>
    <div class="flex border-t border-gray-400 mt-5 py-5 space-x-5">
        <div class="flex-shrink-0">
            <inertia-link :href="route('profiles.show', comment.user.username)">
                <img class="h-8 w-8 rounded-full object-cover" :src="comment.user.profile_photo_url" :alt="comment.user.username">
            </inertia-link>
        </div>

        <div class="flex-1">
            <div>
                <h2 class="text-lg font-semibold underline">
                    <inertia-link :href="route('profiles.show', comment.user.username)">{{ comment.user.username }}</inertia-link>
                    </h2>
                <p class="bg-gray-100 rounded mt-3 px-3 py-2">
                    {{ comment.body }}
                </p>
            </div>
            <div class="relative">
                        <button type="button" class="focus:outline-none" @click="openMenu = !openMenu">It</button>
                        <div v-if="openMenu" class="bg-gray-300 text-sm absolute w-48 right-0 text-gray-700 shadow-lg rounded-md px-4 py-2 hover:bg-gray-700 hover:text-gray-300 transition duration-150 ease-in-out">
                            <form @submit.prevent="deleteComment">
                                <button type="submit" class="flex justify-between items-center w-full focus:outline-none">
                                    DeletePost
                                </button>
                            </form>
                        </div>
                    </div>
            <div class="flex items-end my-3">
                <div>
                    <span class="text-sm italic">{{ comment.created_at  }}</span>
                </div>
                <div class="flex ml-3">
                    <like :item="comment" :method="submitLike"></like>
                    <dislike :item="comment" :method="submitDislike" class="ml-2"></dislike>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Dislike from '@/Components/Dislike'
    import Like from '@/Components/Like'
    export default {
        props: ['comment'],
        components: {
            Dislike,
            Like,
        },
        data() {
            return {
                openMenu:false,
                deleteForm: this.$inertia.form({
                    comment: this.comment
                }),
               form: this.$inertia.form({
                    body: this.body,
                    user_id: this.comment.id,
                }),
                likeForm: this.$inertia.form({
                    comment: this.comment
                }),
                dislikeForm: this.$inertia.form({
                    comment: this.comment
                }),
            }
        },
        methods: {
            deleteComment() {
                this.openMenu = false
                this.deleteForm.delete(this.route('comments.destroy', this.comment.id), {
                    preserveScroll: true,
                    onSuccess:()=>{
                        Toast.fire({
                            icon: 'success',
                            title: 'Post has successfully been deleted!'
                        })
                    }
                })
            },
            submitLike() {
                this.likeForm.post(this.route('comment-like.store', this.comment.id), {
                    preserveScroll: true,
                    onSuccess:()=>{}
                })
            },
            submitDislike() {
                this.dislikeForm.delete(this.route('comment-like.destroy', this.comment.id), {
                    preserveScroll: true,
                    onSuccess:()=>{}
                })
            },
        }
    }
</script>