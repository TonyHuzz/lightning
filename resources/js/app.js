import './bootstrap';
import '../css/app.css';
import '@purge-icons/generated';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
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
        color: '#4B5563',
    },
});
