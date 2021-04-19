<template>
    <page-layout>
        <template #title>
            <div class="flex justify-between items-center w-full">
              <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                  <img :src="$page.props.user.profile_photo_url" alt="$page.props.user.username" class="h-8 w-8 rounded-full object-cover">
                  <span class="capitalize ml-3">Dashboard</span> 
              </h2>
            </div>
        </template>
          <form @submit.prevent="submit" class="w-full">
        <div>
            <textarea name="post" rows="3" class="border rounded px-2 py-2 w-full" :placeholder="`Say ${$page.props.user.username} ...`" v-model="form.body"></textarea>
        </div>
        <div class="flex justify-between my-3">
            <div>
                <jet-input-error :message="form.errors.body" class="mt-2" v-if="form.errors.body" ></jet-input-error>
            </div>
            <div>
                <add-button type="submit" class="text-xs" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    <fingerprint-spinner
                        :animation-duration="1500"
                        :size="20"
                        class="text-white" 
                        v-if="form.processing"
                    />
                    <span v-else>Post</span>
                </add-button>
            </div>
        </div>
    </form>
        <follower :followers="followers"></follower>
        <block-posts :posts="allPosts.data"></block-posts>
        <form-post :method="submit" :form="form" :text="'Post'"></form-post>
    </page-layout>
</template>

<script>
    import PageLayout from '@/Layouts/PageLayout'
    import { FingerprintSpinner } from 'epic-spinners'
    import JetInputError from '@/Jetstream/InputError'
    import BlockPosts from '@/Components/BlockPosts'
    import FormPost from '@/Components/FormPost'
    import AddButton from '@/Components/AddButton'
    import Follower from '@/Components/Follower.vue'

    export default {
        props: ['allPosts', 'followers' ],
        components: {
            BlockPosts,
            AddButton,
            PageLayout,
            JetInputError,
            FormPost ,
            FingerprintSpinner,
            Follower,
         },
        data() {
            return {
                form: this.$inertia.form({
                    user_id: this.$page.props.user.id,
                    body: this.body
                })
            }
        },
        methods: {
            submit() {
                this.form.post(this.route('posts.store'), {
                    preserveScroll: true,
                    onSuccess:()=> {}
                })
            },
        }
    }
</script>
