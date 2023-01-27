<script setup>
import App from '@/core/app';
import { UpdateConfig } from '@/core/crud/configs';

import Data from './form/Data.vue';
import AccordionsButtons from './form/accordions/Buttons.vue';
import TabsButtons from './form/tabs/Buttons.vue';
</script>

<script>
export default {
    props: {
        config: {
            type: UpdateConfig,
            required: true,
        },
        actions: {
            type: Array,
        },
        layout: {
            type: String,
            default: 'tabs',
        },
    },
    data() {
        return {
            model: null,
            elementId: App.helpers.string.uniqueElementId(),
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
    <TabsButtons v-if="layout === 'tabs'" :actions="actions" :elementId="elementId" />
    <Data v-if="model" :config="config" :model="model" :layout="layout" :elementId="elementId" />
    <AccordionsButtons v-if="layout === 'accordions'" :actions="actions" :elementId="elementId" />
</template>
