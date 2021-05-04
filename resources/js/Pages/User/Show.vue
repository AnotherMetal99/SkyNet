<template>
    <page-layout>
        <template #title>
            <div class="flex justify-between items-center w-full"> 
                <div class="font-semibold text-gray-800 leading-tight capitalize ml-3">{{ `${profile.name}` }}
                  <img :src="profile.profile_photo_url" alt="profile.username" class="h-40 w-40 rounded-full object-cover">
              </div>
            </div>
            <div class="capitalize ml-4">Email: {{ `${profile.email}` }}</div> 
            <div class="capitalize ml-4">Age: {{ `${profile.age}` }}</div>  
            <div class="capitalize ml-4">Friends: {{`${friends.length}`}}</div> 
            <div class="capitalize ml-4">Requests: {{`${requests.length}`}}</div> 
            <div class="flex justify-between items-center w-full"> 
            <status :profile="profile" :friendsWith="friendsWith" :friendPendingFrom="friendPendingFrom" :friendSentTo="friendSentTo" ></status>
            </div>
        </template>
          <div>
            <h3 class="font-semibold text-lg text-gray-800 leading-tight mt-8">
                Friends:
            </h3>
            <block-folow :items="friends"></block-folow>
          </div>

        <div class="font-semibold text-lg text-gray-800 leading-tight mt-8">
        <form-post :method="submit" :form="form" :text="'Post'"></form-post>
        <block-posts :posts="posts.data"></block-posts>
         </div>
         
    </page-layout>
</template>

<script>
    import PageLayout from '@/Layouts/PageLayout'
    import BlockPosts from '@/Components/BlockPosts'
    import Post from '@/Components/Post'
    import FormPost from '@/Components/FormPost'
    import BlockFolow from '@/Components/BlockFolow'
    import Status from '@/Components/Status'
    export default {
       props: ['profile','friendsWith','friendPendingFrom','friendSentTo','posts','friends', 'requests'],
        components: {
            PageLayout,
            Status,
            BlockFolow,
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

