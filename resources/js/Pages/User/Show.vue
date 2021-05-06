<template>
    <page-layout>
        <template #title>
            <figure class="md:flex bg-indigo-200 rounded-xl p-8 md:p-8">
              <img :src="profile.profile_photo_url" alt="profile.username" class="w-32 h-32 md:w-60 md:h-auto  rounded-full mx-auto"  width="384" height="512">
              <div class="pt-6 md:p-8 text-center md:text-left space-y-4">
              <blockquote>
              <p class="text-lg">
                    <div class="font-semibold">{{ `${profile.name}` }}</div> 
                    <div class="font-semibold ">Возраст: {{ `${profile.age}` }}</div> 
                    <div class="font-semibold">Email: {{ `${profile.email}` }}</div>
             </p>
             </blockquote>
             <figcaption class="font-medium">
            <div style="blockquote-footer">
            О себе: {{ `${profile.bio}` }}
           </div>
         <div class="mt-2">
         <status :profile="profile" :friendsWith="friendsWith" :friendPendingFrom="friendPendingFrom" :friendSentTo="friendSentTo" ></status>
        </div>
        </figcaption>
       </div>
      </figure>
        </template>
        <div class="font-semibold text-lg text-gray-800 leading-tight ml-5 mt-8">
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
       props: ['profile','friendsWith','friendPendingFrom','friendSentTo','posts', 'requests'],
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

