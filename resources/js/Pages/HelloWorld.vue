<template>
    <Head title="hello world123" />

    <div>
        <Link href="/">Home</Link>
        <Link href="/about">About</Link>
    </div>
    <h1>Hello {{ name }}</h1>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    name: {
        type: String,
        default: 'world',
    },
})

</script>

<style scoped>

</style>
