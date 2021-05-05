<template>
    <page-layout>
        <template #title>
            <div class="flex justify-between items-center ">
              <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                  <img :src="$page.props.user.profile_photo_url" alt="$page.props.user.username" class="h-8 w-8 rounded-full object-cover">
                  <span class="capitalize ml-3">Главная</span> 
              </h2>
            </div>
        </template>
        <form-post :method="submit" :form="form" :text="'Добавить'"></form-post>
        <follower :followers="followers"></follower>
        <infinite-scroll @loadMore="loadMorePosts">
           <block-posts :posts="allPosts.data" :pagination="pagination"></block-posts>
        </infinite-scroll>
    </page-layout>
</template>

<script>
    import PageLayout from '@/Layouts/PageLayout'
    import { FingerprintSpinner } from 'epic-spinners'
    import JetInputError from '@/Jetstream/InputError'
    import BlockPosts from '@/Components/Dashboard/BlockPosts'
    import FormPost from '@/Components/Dashboard/FormPost'
    import AddButton from '@/Components/Dashboard/AddButton'
    import Follower from '@/Components/Dashboard/Follower.vue'
    import InfiniteScroll from '@/Components/InfiniteScroll'

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
            InfiniteScroll 
         },
        data() {
            return {
                form: this.$inertia.form({
                    user_id: this.$page.props.user.id,
                    body: this.body
                }),
                allPosts: this.allPosts
            }
        },
        computed: {
            pagination() {
                return this.allPosts = this.allPosts
            }
        },
        methods: {
            submit() {
                this.form.post(this.route('posts.store'), {
                    preserveScroll: true,
                    onSuccess:()=> {
                        Toast.fire({
                            icon: 'success',
                            title: 'Ваша запись добавлена!'
                        }),
                        this.form.body = null
                    }
                })
            },
            loadMorePosts() {
                if (!this.allPosts.next_page_url) {
                    return
                }
                return axios.get(this.allPosts.next_page_url)
                    .then(resp => {
                        this.allPosts = {
                            ...resp.data,
                            data: [
                                ...this.allPosts.data, ...resp.data.data
                            ]
                        }
                    })
            }
        }
    }
</script>
