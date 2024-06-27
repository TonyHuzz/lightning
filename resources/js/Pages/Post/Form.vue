<template>
    <div class="py-6 md:py-8">
        <form @submit.prevent="submit" class="card card-main">
            <h1 class="text-3xl text-center">{{ pageTitle }}</h1>
            <div class="w-12 mt-1 mx-auto border-b-4 border-purple-400"></div>

            <div class="grid gap-6 mt-6">
                <TextInput v-model="form.title" :error="form.errors.title" label="標題" autofocus/>
                <TextAreaInput v-model="form.content" :error="form.errors.content" label="內容"/>
                <FileInput
                    v-model="form.thumbnail"
                    :error="form.errors.thumbnail"
                    accept="image/*"
                    label="分享預覽圖片"
                    browseText="選擇圖片"
                />
                <img v-if="props.post.thumbnail" :src="props.post.thumbnail" class="max-w-xs rounded shadow" alt=""/>
                <div class="font-light mb-4 flex items-center">
                    <input type="checkbox" class="checkbox" v-model="form.is_published"/>
                    <label>發布文章</label>
                </div>
                <div class="flex items-center space-x-4">
                    <LoadingButton :loading="loading" class="btn btn-purple">{{ btnText }}</LoadingButton>
                </div>
            </div>
        </form>
    </div>
</template>


<script setup>

import {computed, ref} from "vue";
import {useForm, useRemember} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import TextAreaInput from "@/Components/TextAreaInput.vue";
import FileInput from "@/Components/FileInput.vue";
import LoadingButton from "@/Components/LoadingButton.vue";

const props = defineProps({
    post: {
        type: Object,
    }
});

const loading = ref(false);

const form = useForm('CreatePost', {
    title: props.post.title,
    content: props.post.content,
    thumbnail: null,
    is_published: props.post.is_published,
});

const pageTitle = computed(() => '撰寫文章');
const btnText = computed(() => '儲存文章');

const submit = () => {
    form.post(route('posts.store', {
        onStart() {
            loading.value = true;
        },
        onFinish() {
            loading.value = false;
        },
        onSuccess() {
            if (!form.hasErrors()) {
                form.reset('thumbnail');

            }
        }
    }))
}

</script>
