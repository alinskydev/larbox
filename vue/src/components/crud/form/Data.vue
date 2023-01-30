<script setup>
import App from '@/core/app';
import * as Enums from '@/core/enums';

import Accordions from './data/Accordions.vue';
import Tabs from './data/Tabs.vue';
</script>

<script>
export default {
    props: {
        config: {
            type: Object,
            required: true,
        },
        model: {
            type: Object,
            required: true,
        },
        layout: {
            type: Number,
            required: true,
        },
        elementId: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            submit: (event) => {
                let http = this.config.http,
                    formData = new FormData(event.target);

                if (this.config.events.beforeSubmit) {
                    this.config.events.beforeSubmit(formData);
                }

                App.helpers.http
                    .send({
                        method: 'POST',
                        path: http.path,
                        query: {
                            ...http.query,
                            ...{
                                _method: http.method,
                            },
                        },
                        body: formData,
                    })
                    .then((response) => {
                        if (response.statusType === 'success') {
                            if (this.config.events.afterSubmit) {
                                this.config.events.afterSubmit(formData, response);
                            } else {
                                toastr.success(App.t('Сохранение прошло успешно'));
                                App.page.goUp();
                            }
                        }
                    });
            },
        };
    },
};
</script>

<template>
    <Accordions v-if="layout === Enums.crudFormDataLayouts.accordions" :model="model" :elementId="elementId" />
    <Tabs v-if="layout === Enums.crudFormDataLayouts.tabs" :model="model" :elementId="elementId" />
</template>
