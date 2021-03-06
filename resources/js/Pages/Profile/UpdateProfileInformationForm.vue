<template>
    <jet-form-section @submitted="updateProfileInformation">
        <template #title>
            Информация пользователя
        </template>

        <template #description>
            Обновите информацию в профиле вашей учетной записи и адрес электронной почты.
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div class="col-span-6 sm:col-span-4" v-if="$page.props.jetstream.managesProfilePhotos">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            ref="photo"
                            @change="updatePhotoPreview">

                <jet-label for="photo" />

                <!-- Current Profile Photo -->
                <div class="mt-1" v-show="! photoPreview">
                    <img :src="user.profile_photo_url" :alt="user.name" class="rounded-full h-40 w-40 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" v-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                          :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <jet-secondary-button class="mt-5 mr-2" type="button" @click.prevent="selectNewPhoto">
                    Выбрать новую фотографию
                </jet-secondary-button>

                <jet-secondary-button type="button" class="mt-2" @click.prevent="deletePhoto" v-if="user.profile_photo_path">
                    Удалить фото
                </jet-secondary-button>

                <jet-input-error :message="form.errors.photo" class="mt-2" />
            </div>


            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="name" value="Имя" />
                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name" />
                <jet-input-error :message="form.errors.name" class="mt-2" />
            </div>

             <!-- Lastname -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="lastname" value="Фамилия" />
                <jet-input id="lastname" type="text" class="mt-1 block w-full" v-model="form.lastname" autocomplete="lastname" />
                <jet-input-error :message="form.errors.lastname" class="mt-2" />
            </div>

             <!-- Username -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="username" value="Ник" />
                <jet-input id="username" type="text" class="mt-1 block w-full" v-model="form.username" autocomplete="username" />
                <jet-input-error :message="form.errors.username" class="mt-2" />
            </div>

            <!-- Age -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="age" value="Возраст" />
                <jet-input id="age" type="text" class="mt-1 block w-full" v-model="form.age" autocomplete="age" />
                <jet-input-error :message="form.errors.age" class="mt-2" />
            </div>

            <!-- Bio -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="bio" value="Bio" />
                <jet-input id="bio" type="text" class="mt-1 block w-full" v-model="form.bio" autocomplete="bio" />
                <jet-input-error :message="form.errors.bio" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="email" value="Почта" />
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" />
                <jet-input-error :message="form.errors.email" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Сохранен.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Сохранить
            </jet-button>
        </template>
    </jet-form-section>
</template>


<script>
    import JetButton from '@/Jetstream/Button'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'

    export default {
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
        },

        props: ['user'],

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'PUT',
                    name: this.user.name,
                    lastname: this.user.lastname,
                    username: this.user.username,
                    age: this.user.age,
                    bio: this.user.bio,
                    email: this.user.email,
                    photo: null,
                }),

                photoPreview: null,
            }
        },

        methods: {
            updateProfileInformation() {
                if (this.$refs.photo) {
                    this.form.photo = this.$refs.photo.files[0]
                }

                this.form.post(route('user-profile-information.update'), {
                    errorBag: 'updateProfileInformation',
                    preserveScroll: true
                });
            },

            selectNewPhoto() {
                this.$refs.photo.click();
            },

            updatePhotoPreview() {
                const reader = new FileReader();

                reader.onload = (e) => {
                    this.photoPreview = e.target.result;
                };

                reader.readAsDataURL(this.$refs.photo.files[0]);
            },

            deletePhoto() {
                this.$inertia.delete(route('current-user-photo.destroy'), {
                    preserveScroll: true,
                    onSuccess: () => (this.photoPreview = null),
                });
            },
        },
    }
</script>
