<template>
    <div class="py-6 md:py-8">
        <form @submit.prevent="submit" class="card card-main">
            <h1 class="text-3xl font-semibold text-center">帳號設定</h1>
            <div class="w-12 mt-1 mx-auto border-b-4 border-purple-400"></div>

            <Alert v-if="$page.props.flash.success || $page.props.flash.error" class="mt-6"></Alert>

            <div class="grid gap-6 mt-6 md:grid-cols-2">
                <TextInput v-model="form.name" :error="form.errors.name" label="姓名" autocomplete="name" autofocus />
                <TextInput v-model="form.email" :error="form.errors.email" label="Email" autocomplete="email" />
                <TextAreaInput v-model="form.description" :error="form.errors.description" class="md:col-span-2" label="個人簡介" />
                <TextInput v-model="form.password" :error="form.errors.password" type="password" label="密碼" />
                <TextInput v-model="form.password_confirmation" type="password" label="確認密碼" />
                <FileInput v-model="form.avatar" :error="form.errors.avatar" accept="image/*" label="大頭照" browseText="選擇圖片" />
                <div class="md:col-span-2">
                    <LoadingButton :loading="loading" class="btn btn-purple">更新帳號</LoadingButton>
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
import TextInput from "@/Components/TextInput.vue";
import {useForm} from "@inertiajs/vue3";
import {ref} from "vue";
import TextAreaInput from "@/Components/TextAreaInput.vue";
import FileInput from "@/Components/FileInput.vue";
import LoadingButton from "@/Components/LoadingButton.vue";
import Alert from "@/Components/Alert.vue";

const props = defineProps({
    user: Object,
})

const loading = ref(false);

const form = useForm({
    _method: 'PUT',
    name: props.user.name,
    email: props.user.email,
    description: props.user.description,
    password: '',
    password_confirmation: '',
    avatar: null,
});

const submit = () => {
    form.post(route('user.update'), {
        // forceFormData: true,
        onStart() {
            loading.value = true;
        },
        onFinish() {
            loading.value = false;
        },
        onSuccess() {
            form.reset('password', 'password_confirmation', 'avatar');
        }
    })
}

</script>

