<script setup>
import App from '@/core/app';
import { UpdateConfig } from '@/core/crud/configs';
import Accordion from '@/components/crud/form/Accordion.vue';
</script>

<script>
export default {
    props: {
        config: {
            type: UpdateConfig,
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
    <Accordion v-if="model" :config="config" :model="model" />
</template>
