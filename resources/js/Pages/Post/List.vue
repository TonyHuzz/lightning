<template>
    <div class="py-6 md:py-8">
        <Alert v-if="$page.props.flash.success || $page.props.flash.error"/>

        <div class="card card-main">
            <div>
                <div class="flex justify-between items-center">
                    <h2 class="text-3xl">我的{{ typeText }}</h2>
                    <div>
                        <Link :href="$route('posts.create')" class="link">
                            <Icon icon="heroicons-outline:pencil"/>
                            撰寫文章
                        </Link>
                    </div>
                </div>
                <hr class="mt-4"/>

                <Tabs class="mt-4" :active="type">
                    <Tab name="published" :url="$route('posts.index')">已發布</Tab>
                    <Tab name="drafts" :url="$route('posts.drafts')">草稿</Tab>
                </Tabs>
            </div>

            <div class="mt-6">
                <PostList :posts="posts" hide-author :empty="`目前沒有${typeText}`">
                    <template #info-after="{ post }">
                        <div>
                            <Link :href="$route('posts.edit', { post: post.id })" class="link">
                                <icon icon="heroicons-outline:pencil"/>
                                編輯
                            </Link>
                        </div>
                        <div>
                            <a :href="$route('posts.destroy', { post: post.id })" class="link"
                               @click.prevent="destroy(post)">
                                <icon icon="heroicons-outline:trash"/>
                                刪除
                            </a>
                        </div>
                    </template>
                </PostList>
            </div>
        </div>
    </div>

</template>


<script setup>

import Alert from "@/Components/Alert.vue";
import {Link} from "@inertiajs/vue3";
import Icon from "@/Components/Icon.vue";
import PostList from "@/Components/PostList.vue";
import Tabs from "@/Components/Tabs.vue";
import Tab from "@/Components/Tab.vue";

const props = defineProps({
    type: String,
    typeText: String,
    posts: Object,
});

const destroy = (post) => {
    if (confirm('確定要刪除這篇文章嗎？')) {
        post.delete(route('posts.destroy', {post: post.id}));
    }
};

</script>
