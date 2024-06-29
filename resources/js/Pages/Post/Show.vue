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
                <div class="flex space-x-4 mt-2 text-sm">
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
                </div>

                <Markdown class="mt-6" :value="props.post.content"/>
            </div>

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
                        </div>
                    </div>

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

const props = defineProps({
    post: {
        type: Object,
    }
});


</script>
