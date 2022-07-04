<script setup>
import Grid from '@/app/components/crud/show/Grid.vue';
</script>

<script>
export default {
    data() {
        return {
            page: this.booted.components.current.page,
            config: this.booted.components.current.config,
            model: this.booted.components.current.config.model,
            items: {},
        };
    },
    created() {
        let http = this.config.http;

        http.path = http.path.replace(':id', this.$route.params.id);

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

                // Collecting items

                this.items = this.model.prepareValues(this, this.model.show, response.data);
            } else {
                this.$router.back();
            }
        });
    },
};
</script>

<template>
    <Grid :items="items" />
</template>