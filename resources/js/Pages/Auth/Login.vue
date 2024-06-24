<template>
    <div class="py-6 md:py-8">
        <form @submit.prevent="submit" class="card max-w-sm p-6 md:p-8 mx-auto">
            <h1 class="text-3xl text-center">登入</h1>
            <div class="w-12 mt-1 mx-auto border-b-4 border-purple-400"></div>

            <div class="grid gap-6 mt-6">
                <TextInput v-model="form.email" :error="form.errors.email" label="E-mail" autocomplete="email" autofocus />
                <TextInput v-model="form.password" type="password" label="密碼" />
                <div>
                    <label>
                        <input type="checkbox" class="form-checkbox text-purple-500 outline-none shadow-none focus:ring-0 checked:border-purple-500" v-model="form.remember" /> 記住我
                    </label>
                </div>
                <div>
                    <LoadingButton :loading="loading" class="btn btn-purple">
                        登入
                    </LoadingButton>
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
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onStart() {
            loading.value = true;
        },
        onFinish() {
            loading.value = false;
        }
    });
}

</script>
