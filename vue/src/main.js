import { createApp } from 'vue';
import App from './App.vue';
import router from '@/app/core/router';
import config from '@/app/core/config';
import { __ } from '@/app/core/helpers/localizationHelper';

import fileHelper from '@/app/core/helpers/fileHelper';
import httpHelper from '@/app/core/helpers/httpHelper';
import iteratorHelper from '@/app/core/helpers/iteratorHelper';
import stringHelper from '@/app/core/helpers/stringHelper';
import userHelper from '@/app/core/helpers/userHelper';

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
