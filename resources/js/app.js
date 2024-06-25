import './bootstrap';
import '../css/app.css';
import '@purge-icons/generated';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import AppLayout from "@/Layouts/AppLayout.vue";

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${appName}`,
    resolve: (name) => {
        // 設置每個頁面的layout 都會吃 AppLayout.vue
        const pages = import.meta.glob('./Pages/**/*.vue', {eager: true});
        let page = pages[`./Pages/${name}.vue`];
        page.default.layout = page.default.layout || AppLayout;
        return page;
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)

        // 可以在Vue组件中使用$route方法
        app.mixin({
            methods: {
                $route: (name, params, absolute, config = Ziggy) => route(name, params, absolute, config),
            },
        });

        app.mount(el);


    },
    progress: {
        color: '#9F7AEA',
        delay: 250,
        includeCss: true,

    },
});
