import './bootstrap';
import '../css/app.css';
import Layout from  './Layouts/Layout.vue'
import {  createSSRApp, h, onMounted ,createApp} from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import i18n from './i18n/i18n';

const el = window.document.getElementById('app');
const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Radical Flexibility';
app.config.globalProperties.$route = route
createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy,i18n)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
