<template>
    <div class="relative z-50">
        <slot name="button" :open="open" />
        <button v-if="isOpen" @click="close" tabindex="-1" class="fixed z-40 inset-0 h-full w-full cursor-default"></button>
        <Transition
            enter-from-class="opacity-0 scale-90"
            enter-active-class="transition ease-out duration-150 origin-top-right"
            enter-to-class="opacity-1 scale-100"
            leave-from-class="opacity-1 scale-100"
            leave-active-class="transition duration-150 ease-in origin-top-right"
            leave-to-class="opacity-0 scale-90"
        >
            <div v-if="isOpen" class="absolute z-50 right-0 mt-4 py-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg transform">
                <slot name="menu" :close="close" />
            </div>
        </Transition>
    </div>
</template>


<script setup>
import {onBeforeUnmount, onMounted, ref} from 'vue';

const isOpen = ref(false);

const open = () => {
    isOpen.value = true;
}

const close = () => {
    isOpen.value = false;
}

onMounted(() => {
    const handleEscape = (e) => {
        if (['Esc', 'Escape'].includes(e.key)) {
            isOpen.value = false;
        }
    }

    document.addEventListener('keydown', handleEscape);
    onBeforeUnmount(() => {
        document.removeEventListener('keydown', handleEscape);
    })
})


</script>
