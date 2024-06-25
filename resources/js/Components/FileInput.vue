<template>
    <div>
        <label v-if="label" class="form-label">{{ label }}：</label>
        <div class="form-input p-0" :class="{ error }">
            <input
                type="file"
                class="hidden"
                ref="inputRef"
                :accept="accept"
                @change="change"
            />
            <div v-if="!$props.modelValue" class="p-2">
                <button type="button" class="btn-purple-light px-4 py-1 rounded text-ts font-medium select-none transition-colors duration-100" @click="browse">
                    {{ browseText }}
                </button>
            </div>
            <div v-else class="flex items-center justify-between p-2">
                <div class="flex-1 pr-1">
                    {{ $props.modelValue.name }}
                    <span class="text-purple-500 text-xs">
                        {{ fileSize($props.modelValue.size) }}
                    </span>
                </div>
                <button type="button" class="btn-purple-light px-4 py-1 rounded text-xs font-medium select-none transition-colors duration-100" @click="remove">
                    {{ removeText }}
                </button>
            </div>
        </div>
        <div v-if="error" class="form-error">{{ error }}</div>
    </div>
</template>

<script setup>

import {ref, watch} from "vue";

const props = defineProps({
    modelValue: File,
    label: String,
    accept: String,
    browseText: {
        type: String,
        default: '選擇檔案'
    },
    removeText: {
        type: String,
        default: '刪除'
    },
    error: String,
});

const emit = defineEmits(['update:modelValue']);

const inputRef = ref(null);

watch(() => props.modelValue, (newValue) => {
    if (!newValue) {
        inputRef.value.value = '';
    }
});

const fileSize = (size) => {
    let i = Math.floor(Math.log(size) / Math.log(1024));
    return (size / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + ['B', 'KB', 'MB', 'GB', 'TB'][i];
};

const browse = () => {
    inputRef.value.click();
};

const change = (e) => {
    emit('update:modelValue', e.target.files[0]);
};

const remove = () => {
    emit('update:modelValue', null);
};

</script>
