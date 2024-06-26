<template>
    <div class="container py-8">
        <Alert v-if="$page.props.flash.success || $page.props.flash.error" class="mt-6"></Alert>

        <div class="space-x-3 pb-2 border-b border-purple-200">
            <Link href="/" class="link">Home</Link>
            <Link href="/about" class="link">About</Link>
        </div>
        <h1 class="text-2xl mt-2">Hello {{ name }}</h1>
        <Icon :style="'text-purple-600 w-12 h-12'" icon="heroicons-solid:chat" />
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Icon from "@/Components/Icon.vue";
import Alert from "@/Components/Alert.vue";

defineProps({
    name: {
        type: String,
        default: 'world',
    },
})

</script>

<style scoped>

</style>
