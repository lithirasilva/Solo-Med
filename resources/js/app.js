import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp , Head, Link } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import '@fortawesome/fontawesome-free/css/all.min.css';
import AOS from 'aos';
import 'aos/dist/aos.css';
import vuetify from './plugins/vuetify';

AOS.init(); // this is for animate on scroll

const appName = import.meta.env.VITE_APP_NAME || 'SoloMed';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });

        // Use plugins before mounting the app
        app.use(plugin);
        app.use(ZiggyVue);
        app.use(vuetify);
        app.mount(el);
        app.component('InertiaHead', Head);
        app.component('InertiaLink', Link);
    },
    progress: {
        color: '#4B5563',
    },
});

