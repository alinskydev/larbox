<script setup>
import App from '@/core/app';
import { ShowConfig } from '@/core/crud/configs';

import Data from './show/Data.vue';
</script>

<script>
export default {
    props: {
        config: {
            type: ShowConfig,
            required: true,
        },
    },
    data() {
        return {
            model: null,
        };
    },
    created() {
        let http = this.config.http;

        http.path = http.path.replace(':pk', this.$route.params.pk).replace(':slug', this.$route.params.slug);

        App.helpers.http
            .send({
                method: 'GET',
                path: http.path,
                query: http.query,
            })
            .then((response) => {
                if (response.statusType === 'success') {
                    if (this.config.events.afterResponse) {
                        this.config.events.afterResponse(response.data);
                    }

                    this.model = Object.assign({}, this.config.model.fillData(response.data));
                } else {
                    this.$router.back();
                }
            });
    },
};
</script>

<template>
    <Data v-if="model" :model="model" />
</template>
