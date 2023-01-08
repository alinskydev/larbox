<script setup>
import * as Enums from '@/core/enums';

import Accordion from '@/components/crud/form/Accordion.vue';
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

        http.path = http.path.replace(':pk', this.$route.params.pk).replace(':slug', this.$route.params.slug);

        this.booted.helpers.http
            .send(this, {
                method: 'GET',
                path: http.path,
                query: http.query,
            })
            .then((response) => {
                if (response.statusType === 'success') {
                    // Page init

                    if (this.config.title) {
                        this.page.title +=
                            ': ' +
                            this.booted.helpers.iterator.get(
                                response.data,
                                this.config.title.replace(':locale', this.booted.locale),
                            );
                    }

                    this.page.init();

                    // Adding updated_at conflict check

                    if (this.model.hasUpdatedAtConflictCheck) {
                        let firstGroupKey = Object.keys(this.model.form)[0];

                        this.model.form[firstGroupKey].updated_at = {
                            type: Enums.inputTypes.hidden,
                        };
                    }

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
