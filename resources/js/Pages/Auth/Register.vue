<template>
    <div class="py-6 md:py-8">
        <form @submit.prevent="submit" class="card max-w-sm p-6 md:p-8 mx-auto">
            <h1 class="text-3xl text-center">註冊</h1>
            <div class="w-12 mt-1 mx-auto border-b-4 border-purple-400"></div>

            <div class="grid gap-6 mt-6">
                <TextInput v-model="form.name" :error="form.errors.name" label="姓名" autocomplete="name" autofocus />
                <TextInput v-model="form.email" :error="form.errors.email" label="E-mail" autocomplete="email" />
                <TextInput v-model="form.password" :error="form.errors.password" type="password" label="密碼" />
                <TextInput v-model="form.password_confirmation" type="password" label="確認密碼" />
                <div>
                    <LoadingButton :loading="loading" class="btn btn-purple">註冊</LoadingButton>
                </div>
            </div>
        </form>

    </div>
</template>


<script setup>

import {useForm} from "@inertiajs/vue3";
import {ref} from "vue";
import TextInput from "@/Components/TextInput.vue";
import LoadingButton from "@/Components/LoadingButton.vue";

const loading = ref(false);

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onStart() {
            loading.value = true;
        },
        onFinish() {
            loading.value = false;
        }
    });
}

</script>
