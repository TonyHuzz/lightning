<template>
    <div class="flex space-x-2">
        <slot/>
    </div>
</template>

<script setup>

import {provide} from "vue";

const props = defineProps({
    active: String
});

provide('active', props.active);
</script>
