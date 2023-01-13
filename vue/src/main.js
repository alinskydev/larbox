import { createApp } from 'vue';
import router from '@/app/router';
import init from '@/app/init';

import App from './App.vue';

init().then(() => {
    const app = createApp(App);

    app.use(router);
    app.mount('#app');
});
