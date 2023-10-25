import { createApp } from 'vue';
import router from '@/app/router';
import init from '@/app/init';

import App from '@/core/app';
import AppVue from './App.vue';

init().then(() => {
    const app = createApp(AppVue);


    app.mixin({
        data() {
            return {
                elementId: App.helpers.string.uniqueElementId(),
            };
        },
    });

    app.use(router);
    app.mount('#app');
});
