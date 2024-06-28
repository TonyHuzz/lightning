<template>
    <span class="inline-block" :class="['iconify', style]" :data-icon="icon"></span>
</template>

<script setup>

defineProps({
    style: {
        type: String,
        default: "",
    },
    icon: {
        type: String,
        required: true
    },
})

</script>
