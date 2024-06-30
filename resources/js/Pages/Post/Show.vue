<template>
    <Head>
        <meta name="description" :content="props.post.description"/>
        <meta property="og:type" content="website"/>
        <meta property="og:title" :content="props.post.title"/>
        <meta property="og:description" :content="props.post.description"/>
        <meta property="og:image" :content="props.post.thumbnail"/>
        <meta name="twitter:title" :content="props.post.title"/>
        <meta name="twitter:description" :content="props.post.description"/>
        <meta name="twitter:card" content="summary_large_image"/>
        <meta name="twitter:image" :content="props.post.thumbnail"/>
    </Head>

    <div class="py-6 md:py-8">
        <Alert v-if="$page.props.flash.success || $page.props.flash.error" class="shadow mb-6"/>

        <div class="grid gap-6 xl:grid-cols-4">
            <div class="card p-6 md:p-8 min-w-0 xl:col-span-3">
                <h1 class="text-3xl font-semibold leading-snug">{{ props.post.title }}</h1>
                <div class="flex flex-wrap space-x-4 mt-2 text-sm">
                    <div>
                        <Icon :style="'text-purple-500 mr-1'" icon="heroicons-outline:clock"/>
                        <span class="text-gray-500">{{ props.post.created_at }}</span>
                    </div>
                    <div>
                        <Icon :style="'text-purple-500 mr-1'" icon="heroicons-outline:eye"/>
                        <span class="text-gray-500">{{ props.post.visits }}</span>
                    </div>
                    <div v-if="!props.post.is_published">
                        <span class="px-2 py-1 bg-green-100 text-green-700">草稿</span>
                    </div>
                    <Link v-if="post.can.update" :href="$route('posts.edit', { post: post.id })" class="link">
                        <icon icon="heroicons-outline:pencil"/>
                        編輯
                    </Link>
                    <a v-if="post.can.delete" :href="$route('posts.destroy', { post: post.id })" class="link"
                       @click.prevent="destroy(post)">
                        <icon icon="heroicons-outline:trash"/>
                        刪除
                    </a>
                </div>

                <Markdown class="mt-6" :value="props.post.content"/>

                <div class="flex flex-wrap space-x-2 md:space-x-3 mt-6 font-light">
                    <Link
                        :href="$route('posts.like', { post: post.id })"
                        method="post"
                        as="button"
                        class="btn btn-purple-light text-sm px-3 py-1 mb-2"
                        preserveScroll
                        :only="['postOnlyLikes', 'errors']"
                    >
                        <Icon :style="'mr-1 text-purple-500'" :icon="!postOnlyLikes.is_liked
                            ? 'heroicons-outline:heart'
                            : 'heroicons-solid:heart'"
                        />
                        喜歡 | {{ postOnlyLikes.likes }}
                    </Link>
                    <Link v-if="post.can.update"
                          :href="$route('posts.edit', { post: post.id })"
                          class="btn btn-blue-light text-sm px-3 py-1 mb-2"
                    >
                        <icon class="mr-1" icon="heroicons-outline:pencil"/>
                        編輯
                    </Link>
                    <a v-if="post.can.delete"
                       :href="$route('posts.destroy', { post: post.id })"
                       class="btn btn-red-light text-sm px-3 py-1 mb-2"
                       @click.prevent="destroy(post)"
                    >
                        <icon class="mr-1" icon="heroicons-outline:trash"/>
                        刪除
                    </a>
                </div>
                <div v-if="$page.props.errors.like" class="form-error">{{ $page.props.errors.like }}</div>
            </div>

            <!-- 作者卡片 -->
            <div>
                <div class="card p-6 md:p-8 sticky top-8">
                    <Link :href="$route('user.profile', { user: props.post.author.id })">
                        <img :src="props.post.author.avatar" class="rounded-full w-20 h-20 mx-auto" alt=""/>
                    </Link>
                    <div class="mt-4 text-center">
                        <div class="text-2xl font-semibold">
                            <Link :href="$route('user.profile', { user: props.post.author.id })">
                                {{ props.post.author.name }}
                            </Link>
                        </div>
                        <div v-if="props.post.author.description" class="mt-2 text-gray-600 font-light">
                            {{ props.post.author.description }}
                        </div>
                        <div class="flex justify-center items-center space-x-6 mt-3">
                            <Link :href="$route('user.profile', { user: props.post.author.id })">
                                <Icon icon="heroicons-outline:book-open"/>
                                文章 {{ props.post.author.postsCount }}
                            </Link>
                            <Link :href="$route('user.likes', { user: post.author.id })" class="link font-light">
                                <Icon icon="heroicons-outline:heart"/>
                                喜歡 {{ post.author.likesCount }}
                            </Link>
                        </div>
                    </div>

                </div>
            </div>


            <div class="min-w-0 xl:col-span-3">
                <div class="card p-6 md:p-8">
                    <h3 class="text-2xl font-semibold">留言</h3>
                    <CommentForm :post="post" :enabled="Boolean($page.props.auth.user)" class="mt-6"/>
                </div>
            </div>
        </div>
    </div>

</template>


<script setup>
import {Head, Link} from "@inertiajs/vue3";
import Alert from "@/Components/Alert.vue";
import Icon from "@/Components/Icon.vue";
import Markdown from "@/Components/Markdown.vue";
import CommentForm from "@/Components/CommentForm.vue";

const props = defineProps({
    post: {
        type: Object,
    },
    postOnlyLikes: {
        type: Object,
    },
});

const destroy = (post) => {
    if (confirm('確定要刪除這篇文章嗎？')) {
        post.delete(route('posts.destroy', {post: post.id}));
    }
};


</script>
