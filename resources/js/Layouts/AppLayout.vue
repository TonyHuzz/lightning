<template>
    <div class="bg-gray-100 min-h-screen">
        <header class="bg-white shadow">
            <div class="container flex items-center justify-between h-16 md:h-20">
                <h1>
                    <Link href="/" class="block text-2xl font-light italic md:text-3xl">
                        <Icon icon="heroicons-solid:lightning-bolt" :style="'text-purple-500 w-6 h-6 md:w-8 md:h-8'" />
                        <span>{{ $page.title }}</span>
                    </Link>
                </h1>

                <nav>
                    <ul class="flex text-sm md:text-base space-x-1 md:space-x-4 items-center">
                        <template v-if="!user">
                            <li>
                                <Link :href="$route('login')" class="px-3 py-2 md:px-5 rounded text-gray-400 hover:text-gray-900 transition-colors duration-150">
                                    登入
                                </Link>
                            </li>
                            <li>
                                <Link :href="$route('register')" class="px-3 py-2 md:px-5 rounded bg-purple-500 text-white hover:bg-purple-700 transition-colors duration-150" >
                                    註冊
                                </Link>
                            </li>
                        </template>
                        <template v-else>
                            <li>
                                <Dropdown class="text-base">
                                    <template #button="{ open }">
                                        <button @click="open" class="relative z-10 block h-10 w-10 rounded-full overflow-hidden border-2 border-transparent focus:outline-none focus:border-purple-500" >
                                            <img class="h-full w-full object-cover" :src="user.avatar" alt="" />
                                        </button>
                                    </template>
                                    <template #menu="{ close }">
                                        <DropdownItem :href="$route('user.edit')" icon="heroicons-outline:cog" @click="close" >
                                            帳號設定
                                        </DropdownItem>
                                        <DropdownItem :href="$route('logout')" method="post" as="button" icon="heroicons-outline:logout" @click="close">
                                            登出
                                        </DropdownItem>
                                    </template>
                                </Dropdown>
                            </li>
                        </template>
                    </ul>
                </nav>
            </div>
        </header>

        <div class="container">
            <slot />
        </div>
    </div>
</template>

<script setup>
import {Link, usePage} from '@inertiajs/vue3';
import Icon from "@/Components/Icon.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownItem from "@/Components/DropdownItem.vue";
import {computed} from "vue";

const page = usePage()

const user = computed(() => page.props.auth?.user)
</script>
