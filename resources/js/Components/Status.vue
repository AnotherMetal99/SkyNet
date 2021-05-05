<template>
    <div class="flex mt-5 sm:mt-0">
        <template v-if="friendPendingFrom">
            <accept :profile="profile"></accept>
            <ignore :profile="profile" class="ml-3"></ignore>
        </template>
        <template v-else-if="friendSentTo">
            <h3 class="font-semibold text-md text-gray-800 leading-tight">
                В ожидании
            </h3>
        </template>
        <template v-else-if="friendsWith">
            <form @submit.prevent="deleteFriend">
                <jet-danger-button type="submit">
                    <fingerprint-spinner
                        :animation-duration="1500"
                        :size="20"
                        class="text-white"
                        v-if="loading"
                    />
                    <template v-else>
                        Удалить из друзей
                    </template>
                </jet-danger-button>
            </form>
        </template>
        <template v-else-if="$page.props.user.id != profile.id">
            <form @submit.prevent="addFriend">
                <add-button type="submit" class="text-xs">
                    <fingerprint-spinner
                        :animation-duration="1500"
                        :size="20"
                        class="text-white"
                        v-if="loading"
                    />
                    <template v-else>
                        Добавить в друзья
                    </template>
                </add-button>
            </form>
        </template>
    </div>
</template>

<script>
    import { FingerprintSpinner } from 'epic-spinners'
    import Accept from './Accept'
    import AddButton from '@/Components/Dashboard/AddButton'
    import Ignore from './Ignore'
    import JetDangerButton from '@/Jetstream/DangerButton'
    export default {
        props: ['profile','friendsWith','friendPendingFrom','friendSentTo'],
        components: {
            Accept,
            AddButton,
            Ignore,
            FingerprintSpinner,
            JetDangerButton,
        },
        data() {
            return {
                addFriendForm: this.$inertia.form({
                    user: this.profile
                }),
                deleteFriendForm: this.$inertia.form({
                    user: this.profile
                }),
                loading: false,
            }
        },
        methods: {
            addFriend() {
                this.loading = true
                this.addFriendForm.post(this.route('friends.store', this.profile.id), {
                    preserveScroll: true,
                    onSuccess: ()=>{
                        Toast.fire({
                            icon: 'success',
                            title: 'Запрос на добавление в друзья отправлен!'
                        })
                        this.loading = false
                    },
                })
            },
            deleteFriend() {
                this.loading = true
                this.deleteFriendForm.delete(this.route('friends.destroy', this.profile.id), {
                    preserveScroll: true,
                    onSuccess: ()=>{
                        Toast.fire({
                            icon: 'success',
                            title: 'Друг удален!'
                        })
                        this.loading = false
                    },
                })
            },
        }
    }
</script>