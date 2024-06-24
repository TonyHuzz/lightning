<template>
    <Link :href="href" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 focus:bg-gray-100">
        <template v-if="icon">
            <Icon :icon="icon" :style="'mr-2'" />
            <slot />
        </template>
        <slot v-else />
    </Link>
</template>


<script setup>
import { Link } from '@inertiajs/vue3';
import Icon from "@/Components/Icon.vue";

defineProps({
    href: {
        type: String,
        required: true,
    },
    icon: {
        type: String,
    },
});

</script>
