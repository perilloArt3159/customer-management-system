import './bootstrap';
import '../scss/app.scss';

import { createApp, h } from 'vue';
import { createInertiaApp, Head, Link } from '@inertiajs/inertia-vue3';
import { InertiaProgress, inertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

import DefaultLayout from '@/Pages/Layouts/LayoutDashboard.vue';

createInertiaApp(
    {
        title  : title => `Customer Management System`,
        resolve: async name =>
        {
            //! CREDIT : https://stackoverflow.com/questions/72864434/default-persistent-layout-in-laravel-inertia-vite
            const page = resolvePageComponent(
                `./Pages/${name}.vue`,
                import.meta.glob("./Pages/**/*.vue")
            );
            
            page.then((module) =>
                {
                    module.default.layout = module.default.layout || DefaultLayout;
                }
            );

            return page;
        },
        setup({ el, App, props, plugin })
        {
            createApp({ render: () => h(App, props) })
                .use(plugin)
                .component('Head', Head)
                .component('Link', Link)
                .mount(el)
        },
    }
);

InertiaProgress.init();
