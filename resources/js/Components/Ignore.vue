<template>
    <form @submit.prevent="acceptFriend">
        <friend-button type="submit" class="text-xs">
            <fingerprint-spinner
                :animation-duration="1500"
                :size="20"
                class="text-white"
                v-if="loading"
            />
            <template v-else>
                Accept
            </template>
        </friend-button>
    </form>
</template>

<script>
    import { FingerprintSpinner } from 'epic-spinners'
    import FriendButton from '@/Components/FriendButton'
    export default {
        props: ['profile'],
        components: {
            FingerprintSpinner,
            FriendButton,
        },
        data() {
            return {
                acceptFriendForm: this.$inertia.form({
                    user: this.profile
                }),
                loading: false
            }
        },
        methods: {
            acceptFriend() {
                this.loading = true
                this.acceptFriendForm.patch(this.route('friends.update', this.profile.id), {
                    preserveScroll: true,
                    onSuccess:()=>{
                        Toast.fire({
                            icon: 'success',
                            title: 'Successfully accepted request!'
                        })
                        this.loading = false
                    }
                })
            }
        }
    }
</script>
