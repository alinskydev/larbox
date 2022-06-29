<script setup>
import * as crudEnums from '@/app/core/crud/enums';

import ShowGrid from '@/app/components/crud/show/Grid.vue';
import FormAccordion from '@/app/components/crud/form/Accordion.vue';
</script>

<script>
export default {
    props: {
        child: {
            type: String,
            required: true,
            validator(value) {
                return ['show', 'form'].includes(value);
            },
        },
    },
    data() {
        return {
            page: this.booted.components.page,
            items: {},
        };
    },
    created() {
        let model = this.page.model,
            http = this.page.http;

        http.path = http.path.replace(':id', this.$route.params.id);

        this.booted.helpers.http.send(this, {
            method: 'GET',
            path: http.path,
            query: http.query,
        }).then((response) => {
            if (response.statusType === 'success') {
                response.json().then((data) => {

                    // Page init

                    let titleField = this.page.titleField;

                    titleField = titleField.replace(':locale', this.booted.locale);

                    this.page.title += ': ' + this.booted.helpers.iterator.get(data, titleField);
                    this.page.$data.init();

                    // Collecting items

                    switch (this.child) {
                        case 'show':
                            this.items = model.prepareValues(this, model.show, data);
                            break;
                        case 'form':
                            for (let key in model.form) {
                                this.items[key] = model.prepareInputs(this, model.form[key], data);
                            }
                            break;
                    }
                });
            } else {
                this.$router.back();
            }
        });
    },
};
</script>

<template>
    <ShowGrid v-if="child === 'show'" :items="items" />
    <FormAccordion v-else-if="child === 'form'" :itemGroups="items" />
</template>