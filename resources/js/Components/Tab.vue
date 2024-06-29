<template>
    <div v-if="name === active" class="tab tab-active">
        <slot/>
    </div>
    <Link v-else :href="url" class="tab tab-link">
        <slot/>
    </Link>

</template>


<script setup>
import {Link} from "@inertiajs/vue3";
import {inject} from "vue";

const props = defineProps({
    name: {
        type: String,
        required: true,
    },
    url: String,
});

const active = inject('active');
</script>
