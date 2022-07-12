<script setup>
import Accordion from '@/app/components/crud/form/Accordion.vue';
</script>

<script>
export default {
    data() {
        return {
            page: this.booted.components.current.page,
            config: this.booted.components.current.config,
            model: this.booted.components.current.config.model,
            itemGroups: {},
        };
    },
    created() {
        let http = this.config.http;

        http.path = http.path
            .replace(':id', this.$route.params.id)
            .replace(':slug', this.$route.params.slug);

        this.booted.helpers.http.send(this, {
            method: 'GET',
            path: http.path,
            query: http.query,
        }).then((response) => {
            if (response.statusType === 'success') {

                // Page init

                if (this.config.titleField) {
                    this.page.title += ': ' + this.booted.helpers.iterator.get(
                        response.data,
                        this.config.titleField.replace(':locale', this.booted.locale)
                    );
                }

                this.page.init();

                // Collecting item groups

                for (let key in this.model.form) {
                    this.itemGroups[key] = this.model.prepareInputs(this, this.model.form[key], response.data);
                }
            } else {
                this.$router.back();
            }
        });
    },
};
</script>

<template>
    <Accordion :itemGroups="itemGroups" />
</template>