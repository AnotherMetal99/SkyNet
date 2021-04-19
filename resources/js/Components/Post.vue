<template>
   <form @submit.prevent="suvmit" class="w-full">

   </form>
</template>

<script>
import { FingerprintSpinner } from 'epic-spinners'
import AddButton from '@/Components/AddButton'
import JetInputError from '@/Jetstream/InputError'
export default {
   props: ['method','form']
}
</script>
