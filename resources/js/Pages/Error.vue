<template>
    <div>
        <div>{{ code }}</div>
        <div>{{ message }}</div>
    </div>
</template>

<script setup>

defineProps({
    code: {
        type: Number,
    },
    message: {
        type: String,
    },
})
</script>
