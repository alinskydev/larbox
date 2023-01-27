<script setup>
import App from '@/core/app';

import AccordionsLayout from './accordions/Layout.vue';
import TabsLayout from './tabs/Layout.vue';
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
            type: String,
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
    <AccordionsLayout v-if="layout === 'accordions'" :model="model" :elementId="elementId" />
    <TabsLayout v-if="layout === 'tabs'" :model="model" :elementId="elementId" />
</template>
