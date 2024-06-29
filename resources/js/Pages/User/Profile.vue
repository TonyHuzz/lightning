<template>
    <div class="py-6 md:py-8">
        <div class="card card-main">
            <div class="md:flex">
                <div class="md:w-32">
                    <img :src="user.avatar" alt="" class="rounded-full w-20 h-20 mx-auto"/>
                </div>
                <div class="mt-4 md:mt-0 md:ml-6 text-center md:text-left">
                    <h1 class="text-3xl font-semibold">{{ user.name }}</h1>
                    <div v-if="user.description" class="mt-2 text-gray-600 font-light">
                        {{ user.description }}
                    </div>

                    <Tabs class="mt-4 justify-center md:justify-start" :active="type">
                        <Tab name="show" :url="$route('user.profile', { user: user.id })">
                            <Icon icon="heroicons-outline:book-open"/>
                            文章 {{ user.postsCount }}
                        </Tab>
                    </Tabs>
                </div>
            </div>
        </div>

        <div class="card card-main mt-6">
            <PostList :posts="user.posts"/>
        </div>
    </div>
</template>


<script setup>
import Tabs from "@/Components/Tabs.vue";
import Tab from "@/Components/Tab.vue";
import Icon from "@/Components/Icon.vue";
import PostList from "@/Components/PostList.vue";

const props = defineProps({
    type: String,
    user: Object
});

</script>
