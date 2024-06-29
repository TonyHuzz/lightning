<template>
    <div class="py-6 md:py-8">
        <form @submit.prevent="submit" class="card card-main">
            <h1 class="text-3xl text-center">{{ pageTitle }}</h1>
            <div class="w-12 mt-1 mx-auto border-b-4 border-purple-400"></div>

            <div class="flex justify-center space-x-4 mt-6">
                <Link v-if="isEdit" :href="$route('posts.show', { post: post.id })" class="link">
                    <Icon :style="'text-purple-500'" icon="heroicons-outline:book-open"/>
                    <span>檢視文章</span>
                </Link>
                <Link :href="$route('posts.index')" class="link">
                    <Icon :style="'text-purple-500'" icon="heroicons-outline:view-list"/>
                    <span>文章列表</span>
                </Link>
            </div>

            <div class="grid gap-6 mt-6">
                <TextInput v-model="form.title" :error="form.errors.title" label="標題" autofocus/>
                <MarkdownInput v-model="form.content" :error="form.errors.content" label="內容" class="min-w-0"/>
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
import {useForm, Link} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import FileInput from "@/Components/FileInput.vue";
import LoadingButton from "@/Components/LoadingButton.vue";
import MarkdownInput from "@/Components/MarkdownInput.vue";
import Icon from "@/Components/Icon.vue";

const props = defineProps({
    post: {
        type: Object,
    }
});

const loading = ref(false);
const pageTitle = computed(() => '撰寫文章');
const btnText = computed(() => '儲存文章');
const isEdit = computed(() => Boolean(props.post.id));

const form = useForm('CreatePost', {
    title: props.post.title,
    content: props.post.content,
    thumbnail: null,
    is_published: props.post.is_published,
    _method: isEdit.value ? 'PUT' : 'POST',
});

const submit = () => {
    const url = isEdit.value ? route('posts.update', {post: props.post.id}) : route('posts.store');

    form.post(url, {
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
    });
}

</script>
