<template>
    <div class="font-medium">
        <div class="flex justify-between md:hidden">
            <template v-for="link in simpleLinks">
                <div v-if="link.url === null" :key="'disabled-' + link.label"
                     class="pagination-item pagination-disabled">
                    {{ link.label }}
                </div>
                <Link v-else :key="link.label" class="pagination-item pagination-link" :href="link.url">
                    {{ link.label }}
                </Link>
            </template>
        </div>
        <div class="hidden md:flex md:flex-wrap">
            <template v-for="link in links">
                <div v-if="link.active" :key="'active-' + link.label"
                     class="pagination-item pagination-active mr-2 mt-2">
                    {{ link.label }}
                </div>
                <div v-else-if="link.url === null" :key="'disabled-' + link.label"
                     class="pagination-item pagination-disabled mr-2 mt-2">
                    {{ link.label }}
                </div>
                <Link v-else :key="link.label" class="pagination-item pagination-link mr-2 mt-2" :href="link.url">
                    {{ link.label }}
                </Link>
            </template>
        </div>
    </div>

</template>


<script setup>
import {Link} from "@inertiajs/vue3";
import {computed} from "vue";

const props = defineProps({
    links: Array,
});

const simpleLinks = computed(() => {
    return [
        props.links.slice(0).shift(),
        props.links.slice(-1).pop(),
    ];
});
</script>
