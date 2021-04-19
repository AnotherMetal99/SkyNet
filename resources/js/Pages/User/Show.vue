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
        <form-post :method="submit" :form="form" :text="'Post'"></form-post>
         <follower :followers="followers"></follower>
        <block-posts :posts="posts.data"></block-posts>
         
    </page-layout>
</template>

<script>
    import PageLayout from '@/Layouts/PageLayout'
    import BlockPosts from '@/Components/BlockPosts'
    import Post from '@/Components/Post'
    import FormPost from '@/Components/FormPost'
    import Follower from '@/Components/Follower.vue'
    import Status from '@/Components/Status'
    export default {
       props: ['profile','friendsWith','friendPendingFrom','friendSentTo','posts','followers'],
        components: {
            PageLayout,
            Status,
            Follower,
            BlockPosts,
            Post,
            FormPost 
        },
         data() {
            return {
                form: this.$inertia.form({
                    body: this.body,
                    user_id: this.profile.id
                }),

            }
        },
        computed: {
            pagination() {
                return this.allPosts = this.posts
            }
        },
        methods: {
            submit() {
                this.form.post(this.route('posts.store'), {
                    preserveScroll: true,
                    onSuccess:()=>{
                        Toast.fire({
                            icon: 'success',
                            title: 'Your post has successfully been published!'
                        })
                        this.form.body = null
                    }
                })
            }
            
        }
    }
</script>

