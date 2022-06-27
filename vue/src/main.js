import { createApp } from 'vue';
import App from './App.vue';
import router from '@/app/core/router';
import config from '@/app/core/config';
import { __ } from '@/app/helpers/localizationHelper';

import fileHelper from '@/app/helpers/fileHelper';
import httpHelper from '@/app/helpers/httpHelper';
import iteratorHelper from '@/app/helpers/iteratorHelper';
import stringHelper from '@/app/helpers/stringHelper';
import userHelper from '@/app/helpers/userHelper';

const app = createApp(App);

app.config.globalProperties = {
    booted: {
        config: config,
        components: [],
        helpers: {
            file: fileHelper,
            http: httpHelper,
            iterator: iteratorHelper,
            string: stringHelper,
            user: userHelper,
        },
    },
    __: __,
};

app.use(router);
app.mount('#app');
