<template>
    <form @submit.prevent="method" class="w-full">
        <div>
            <textarea name="post" rows="3" class="border rounded px-2 py-2 w-full" :placeholder="`${$page.props.user.username}, оставьте свое мнение`" v-model="form.body"></textarea>
        </div>
        <div class="flex justify-between my-3">
            <div>
                <jet-input-error :message="form.errors.body" class="mt-2" v-if="form.errors.body"></jet-input-error>
            </div>
            <div>
                <add-button type="submit" class="text-xs" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    <fingerprint-spinner
                        :animation-duration="1000"
                        :size="24"
                        class="text-white"
                        v-if="form.processing"
                    />
                    <span v-else>{{ text }}</span>
                </add-button>
            </div>
        </div>
    </form>
</template>

<script>
    import { FingerprintSpinner } from 'epic-spinners'
    import AddButton from '@/Components/Dashboard/AddButton'
    import JetInputError from '@/Jetstream/InputError'
    export default {
        props: ['method', 'form', 'text'],
        components: {
            AddButton,
            FingerprintSpinner,
            JetInputError,
        },
    }
</script>