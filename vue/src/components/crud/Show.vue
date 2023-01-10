<script setup>
import Data from '@/components/crud/show/Data.vue';
</script>

<script>
export default {
    data() {
        return {
            page: this.booted.components.current.page,
            config: this.booted.components.current.config,
            model: null,
        };
    },
    created() {
        let http = this.config.http;

        http.path = http.path.replace(':pk', this.$route.params.pk).replace(':slug', this.$route.params.slug);

        this.booted.helpers.http
            .send(this, {
                method: 'GET',
                path: http.path,
                query: http.query,
            })
            .then((response) => {
                if (response.statusType === 'success') {
                    if (this.config.title) {
                        this.page.title +=
                            ': ' +
                            this.booted.helpers.iterator.get(
                                response.data,
                                this.config.title.replace(':locale', this.booted.locale),
                            );
                    }

                    this.page.init();

                    this.model = Object.assign({}, this.config.model.fillData(this, response.data));
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
