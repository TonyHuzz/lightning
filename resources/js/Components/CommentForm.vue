<template>
    <form @submit.prevent="submit">
        <MarkdownInput
            v-model="form.content"
            :placeholder="enabled ? '請輸入留言...' : '登入後即可留言'"
            :editable="enabled"
            short
            :toolbars-flag="enabled"
            :error="form.errors.content"
        />
        <div class="text-right mt-4">
            <LoadingButton v-if="enabled" :loading="loading" class="btn btn-purple">留言</LoadingButton>
            <Link v-else :href="$route('login')" class="btn btn-purple-light">
                登入即可留言
                <Icon :style="'ml-1'" icon="heroicons-outline:arrow-right"/>
            </Link>
        </div>
    </form>
</template>


<script setup>
import {useForm, Link} from "@inertiajs/vue3";
import {ref} from "vue";
import MarkdownInput from "@/Components/MarkdownInput.vue";
import LoadingButton from "@/Components/LoadingButton.vue";
import Icon from "@/Components/Icon.vue";

const props = defineProps({
    post: Object,
    enabled: {
        type: Boolean,
        default: true
    },
});

const loading = ref(false);

const form = useForm({
    content: ''
});

const submit = () => {
    form.post(route('post.comments.store', {post: props.post.id}), {
        preserveScroll: true,
        onStart() {
            loading.value = true;
        },
        onFinish() {
            loading.value = false;
        },
        onSuccess() {
            form.reset();
            loading.value = false;
        },
    });
};
</script>
