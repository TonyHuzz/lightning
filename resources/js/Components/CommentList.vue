<template>
    <ul class="divide-y">
        <li class="flex py-6" v-for="comment in comments">
            <div>
                <Link :href="$route('user.profile', { user: comment.commenter.id })" class="inline-block">
                    <img :src="comment.commenter.avatar" class="rounded-full w-8 h-8" alt=""/>
                </Link>
            </div>

            <div class="flex-1 ml-3 md:ml-4 min-w-0">
                <Link :href="$route('user.profile', { user: comment.commenter.id })"
                      class="font-medium hover:text-purple-500">
                    {{ comment.commenter.name }}
                </Link>

                <div class="flex space-x-4 mt-1 text-sm text-gray-500">
                    <div>
                        <Icon :style="'w-4 h-4 text-purple-500'" icon="heroicons-outline:clock"/>
                        {{ comment.created_at }}
                    </div>
                    <div>
                        <a v-if="comment.can.delete"
                           :href="$route('comments.destroy', { comment: comment.id })"
                           class="link inline-flex items-center"
                           @click.prevent="destroy(comment)"
                        >
                            <Icon icon="heroicons-outline:trash"/>
                            刪除
                        </a>
                    </div>
                </div>

                <Markdown class="mt-3" :value="comment.content"/>
            </div>
        </li>
    </ul>
</template>

<script setup>
import {Link, router} from "@inertiajs/vue3";
import Icon from "@/Components/Icon.vue";
import Markdown from "@/Components/Markdown.vue";

const props = defineProps({
    comments: Array,
});

const destroy = (comment) => {
    if (confirm('確定要刪除留言？')) {
        router.delete(route('comments.destroy', {comment: comment.id}), {
            preserveScroll: true,
        });
    }
};
</script>
