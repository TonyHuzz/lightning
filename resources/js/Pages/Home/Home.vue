<template>
    <div class="py-6 md:py-8">
        <Alert v-if="$page.props.flash.success || $page.props.flash.error"/>

        <div class="card card-main">
            <PostList :posts="posts"/>
        </div>
    </div>
</template>


<script setup>
import Alert from "@/Components/Alert.vue";
import PostList from "@/Components/PostList.vue";

const props = defineProps({
    posts: Object
});
</script>
