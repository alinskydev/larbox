import { createApp } from 'vue';
import App from './App.vue';
import router from '@/core/app/router';
import config from '@/core/app/config';
import { __ } from '@/core/helpers/localizationHelper';

import fileHelper from '@/core/helpers/fileHelper';
import httpHelper from '@/core/helpers/httpHelper';
import iteratorHelper from '@/core/helpers/iteratorHelper';
import stringHelper from '@/core/helpers/stringHelper';
import userHelper from '@/core/helpers/userHelper';

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
