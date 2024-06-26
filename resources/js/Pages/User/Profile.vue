<template>
    <div class="py-6 md:py-8">
        <div class="card card-main">
            <div class="md:flex">
                <div class="md:w-32">
                    <img :src="props.user.avatar" alt="" class="rounded-full w-20 h-20 mx-auto"/>
                </div>
                <div class="mt-4 md:mt-0 md:ml-6 text-center md:text-left">
                    <h1 class="text-3xl font-semibold">{{ props.user.name }}</h1>
                    <div v-if="props.user.description" class="mt-2 text-gray-600 font-light">{{
                            props.user.description
                        }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script setup>
const props = defineProps({
    user: Object
});

</script>
