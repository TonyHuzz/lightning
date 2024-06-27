<template>
    <div>
        <label v-if="label" class="form-label" :for="id">{{ label }}：</label>
        <textarea
            :id="id"
            class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border focus:outline-none focus:shadow-outline focus:border-purple-500"
            ref="input"
            v-bind="$attrs"
            v-model="inputModel"
            :class="{ error }"
        />
        <div v-if="error" class="form-error">{{ error }}</div>
    </div>
</template>

<script setup>

import {onMounted, ref} from "vue";

defineProps({
    id: {
        type: String,
        default: () => `textarea-input-${Math.random().toString(36).substring(2, 9)}`
    },
    label: String,
    error: String,
});

const inputModel = defineModel({
    type: [String, null],
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

</script>
