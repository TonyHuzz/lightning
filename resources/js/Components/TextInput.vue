<template>
    <div>
        <label v-if="label" class="form-label" :for="id">{{ label }}：</label>
        <input
            :id="id"
            :type="type"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-purple-500"
            :class="{ error }"
            ref="input"
            v-bind="$attrs"
            v-model="inputModel"
        />
        <div v-if="error" class="form-error">{{ error }}</div>
    </div>
</template>

<script setup>

import {onMounted, ref} from "vue";

const inputModel = defineModel({
    type: String,
    required: true,
});

defineProps({
    id: {
        type: String,
        default: () => `text-input-${Math.random().toString(36).substring(2, 9)}`
    },
    type: {
        type: String,
        default: 'text'
    },
    label: String,
    error: String,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

</script>
