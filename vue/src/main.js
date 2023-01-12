import { createApp } from 'vue';
import App from './App.vue';
import config from '@/app/config';
import router from '@/app/router';
import Larbox from '@/core/larbox';

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
        components: {},
        helpers: {
            file: fileHelper,
            http: httpHelper,
            iterator: iteratorHelper,
            string: stringHelper,
            user: userHelper,
        },
    },
    __: Larbox.__,
};

app.use(router);
app.mount('#app');
