import { createApp } from 'vue';
import router from '@/app/router';
import init from '@/app/init';

import App from './App.vue';
import CoreApp from '@/core/app';

init().then(() => {
    const app = createApp(App);

    app.use(router);

    app.mixin({
        data() {
            return {
                elementId: CoreApp.helpers.string.uniqueElementId(),
            };
        },
    });

    app.mount('#app');
});
