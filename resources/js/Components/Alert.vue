<template>
    <div v-if="$page.props.flash.success !== null" class="alert alert-success">
        <Icon :style="'mr-1'" icon="heroicons-outline:check-circle"  />
        {{ $page.props.flash.success }}
    </div>
    <div v-else-if="$page.props.flash.error !== null" class="alert alert-error">
        <Icon :style="'mr-1'" icon="heroicons-outline:x-circle" />
        {{ $page.props.flash.error }}
    </div>
</template>


<script setup>
import Icon from "@/Components/Icon.vue";
</script>
