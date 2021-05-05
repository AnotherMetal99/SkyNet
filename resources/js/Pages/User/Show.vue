<template>
    <page-layout>
        <template #title>
            <div class="flex justify-between items-center w-full"> 
                <div class="font-semibold text-gray-800 leading-tight capitalize ml-3">{{ `${profile.name}` }}
                  <img :src="profile.profile_photo_url" alt="profile.username" class="h-40 w-40 rounded-full object-cover">
              </div>
            </div>
            <div class="capitalize ml-4">Email: {{ `${profile.email}` }}</div> 
            <div class="capitalize ml-4">Возраст: {{ `${profile.age}` }}</div>  
            <div class="flex justify-between items-center w-full"> 
            <status :profile="profile" :friendsWith="friendsWith" :friendPendingFrom="friendPendingFrom" :friendSentTo="friendSentTo" ></status>
            </div>
        </template>
        <div class="font-semibold text-lg text-gray-800 leading-tight mt-8">
        <form-post :method="submit" :form="form" :text="'Добавить запись'"></form-post>
        <infinite-scroll @loadMore="loadMorePosts">
           <block-posts :posts="allPosts.data" :pagination="pagination"></block-posts>
        </infinite-scroll>
         </div>
         
    </page-layout>
</template>

<script>
    import PageLayout from '@/Layouts/PageLayout'
    import BlockPosts from '@/Components/Dashboard/BlockPosts'
    import FormPost from '@/Components/Dashboard/FormPost'
    import BlockFolow from '@/Components/BlockFolow'
    import Status from '@/Components/Status'
    import InfiniteScroll from '@/Components/InfiniteScroll'
    export default {
       props: ['profile','friendsWith','friendPendingFrom','friendSentTo','posts','friends', 'requests'],
        components: {
            PageLayout,
            Status,
            BlockFolow,
            BlockPosts,
            FormPost,
            InfiniteScroll
        },
         data() {
            return {
                form: this.$inertia.form({
                    body: this.body,
                    user_id: this.profile.id
                }),
                allPosts: this.posts
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
                            title: 'Ваша запись добавлена!'
                        })
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

