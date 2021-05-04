<template>
    
        <div class="flex flex-col min-h-screen bg-gray-100 ">
            <nav class="bg-white border-b border-black-100 w-full fixed z-20 bg-white">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex-shrink-0 flex items-center">
                                <inertia-link :href="route('dashboard.index')" >
                                    <img src="" alt="Logo">
                                </inertia-link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <jet-nav-link :href="route('dashboard.index')" :active="route().current('dashboard')">
                                    Dashboard
                                </jet-nav-link>

                                <jet-nav-link :href="route('friends.index')" :active="route().current('dashboard')">
                                    Friends
                                </jet-nav-link>
                            </div>

                            
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:justify-end sm:ml-6 w-1/2">

                            <!-- Settings Dropdown -->
                            <div class="flex items-center ml-3 relative">
                                <jet-dropdown align="right" width="48">
                                    <template #trigger>
                                        <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex items-center text-sm  focus:outline-none focus:border-gray-300 transition">
                                            <div class="flex items-center px-4">
                                              <div v-if="$page.props.jetstream.managesProfilePhotos" class="flex-shrink-0 mr-3" >
                                                <img class="h-10 w-10 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                                              </div> 
                                              <div>
                                                <div class="font-medium text-base text-gray-800">{{ $page.props.user.name }}</div>
                                                <div class="font-medium text-sm text-gray-500">{{ $page.props.user.email }}</div>
                                             </div>
                                            </div>
                                        </button>

                                        <span v-else class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                                {{ $page.props.user.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Manage Account
                                        </div>

                                        <jet-dropdown-link :href="route('profiles.show',`${this.$page.props.user.username}`)">
                                            Profile
                                        </jet-dropdown-link>

                                        <jet-dropdown-link :href="route('friends.index')">
                                            Friends
                                        </jet-dropdown-link>

                                        <jet-dropdown-link :href="route('chat-chats.index')">
                                            Chats
                                        </jet-dropdown-link>

                                        <jet-dropdown-link :href="route('members.index')">
                                            Members
                                        </jet-dropdown-link>
                                        

                                        <jet-dropdown-link :href="route('profile.show')">
                                            Edit
                                        </jet-dropdown-link>

                                        <jet-dropdown-link :href="route('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
                                            API Tokens
                                        </jet-dropdown-link>

                                        <div class="border-t border-gray-100"></div>

                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <jet-dropdown-link as="button">
                                                Log Out
                                            </jet-dropdown-link>
                                        </form>
                                    </template>
                                </jet-dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <jet-responsive-nav-link :href="route('dashboard.index')" :active="route().current('dashboard.index')">
                            Dashboard
                        </jet-responsive-nav-link>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="flex items-center px-4">
                            <div v-if="$page.props.jetstream.managesProfilePhotos" class="flex-shrink-0 mr-3" >
                                <img class="h-10 w-10 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                            </div>

                            <div>
                                <div class="font-medium text-base text-gray-800">{{ $page.props.user.name }}</div>
                                <div class="font-medium text-sm text-gray-500">{{ $page.props.user.email }}</div>
                            </div>
                        </div>

                        

                        <div class="mt-3 space-y-1">
                       
                            <jet-responsive-nav-link :href="route('profiles.show',`${this.$page.props.user.username}`)">
                                Profile
                            </jet-responsive-nav-link>

                            <jet-responsive-nav-link :href="route('friends.index')">
                                Friends
                            </jet-responsive-nav-link>
                              <jet-responsive-nav-link :href="route('chat-chats.index')">
                                Chats
                            </jet-responsive-nav-link>

                            <jet-responsive-nav-link :href="route('members.index')" :active="route().current('members.index')">
                                Members
                            </jet-responsive-nav-link>

                           <jet-responsive-nav-link :href="route('profile.show')" :active="route().current('profile.show')">
                                Edit
                            </jet-responsive-nav-link>

                            <jet-responsive-nav-link :href="route('api-tokens.index')" :active="route().current('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
                                API Tokens
                            </jet-responsive-nav-link>

                            <!-- Authentication -->
                            <form method="POST" @submit.prevent="logout">
                                <jet-responsive-nav-link as="button">
                                    Log Out
                                </jet-responsive-nav-link>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
                
            <div class="flex flex-wrap pt-16 sm:flex-nowrap">
                <!-- Sidebar -->
              <!-- <side-bar></side-bar> -->
                <!-- Page Content -->
            <main class="bg-white shadow rounded my-5 py-6 px-4 w-full sm:w-2/3 sm:mx-2 sm:my-3 md:mx-4 md:px-10 lg:mx-auto">
                <slot></slot>
            </main>
            </div>

        </div>
    
</template>

<script>
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    import JetNavLink from '@/Jetstream/NavLink'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'
    import SideBar from '@/Components/SideBar'
    

    export default {
        components: {
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
            SideBar,
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },
        mounted() {
          this.listen()
        },
        methods: {
            listen() {
                Echo.private(`App.Models.User.${this.$page.props.user.id}`)
                    .notification((notification) => {
                        let newUnreadNotifications = {
                            data: {
                                info: {
                                    avatar: notification.info.avatar,
                                    message: notification.info.message,
                                    link: notification.info.link,
                                    sent: notification.info.sent,
                                }
                            },
                            id: notification.id
                        }
                        this.unreadNotifications.push(newUnreadNotifications)
                        this.notifications.push(newUnreadNotifications)
                    })
            },
            logout() {
                this.$inertia.post(route('logout'));
            },
        }
    }
</script>

<style>
    body.swal2-toast-shown .swal2-container.swal2-top-end, body.swal2-toast-shown .swal2-container.swal2-top-right {
        top: 60px;
    }
</style>