<template>
    <page-layout>
        <template #title>
            <div class="flex  flex-col sm:justify-between sm:flex-row items-center">
              <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                  <span >
                     Рекомендации
                  </span>
              </h2>
              <span class="text-gray-800 leading-tight text-lg capitalize mt-5 sm:mt-0">
                 Страница
                 <inertia-link :href="route('friends.index')" class="underline hover:text-green-500">
                     друзья
                  </inertia-link>
              </span>
            </div>
        </template>
        <infinite-scroll @loadMore="loadMoreMembers">
           <member :items="allMembers.data"></member>
        </infinite-scroll>
    </page-layout>
</template>

<script>
    import PageLayout from '@/Layouts/PageLayout'
    import Member from '@/Components/Followers/Member'
    import InfiniteScroll from '@/Components/InfiniteScroll'
    export default {
       props: ['members'],
        components: {
            PageLayout,
            Member,
            InfiniteScroll
        },
        data() {
            return {
                allMembers: this.members
            }
        },
        methods: {
            loadMoreMembers() {
                if (!this.allMembers.next_page_url) {
                    return
                }
                return axios.get(this.allMembers.next_page_url)
                    .then(resp => {
                        this.allMembers = {
                            ...resp.data,
                            data: [
                                ...this.allMembers.data, ...resp.data.data
                            ]
                        }
                    })
            }
        },
    }
</script>

