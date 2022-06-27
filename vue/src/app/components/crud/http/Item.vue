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

                    this.page.title += ': ' + this.booted.helpers.iterator.searchByPath(data, titleField);
                    this.page.$data.init();

                    // Collecting items

                    let items = {};

                    switch (this.child) {
                        case 'show':
                            let fields = model.show;

                            for (let fieldKey in fields) {
                                let field = fields[fieldKey],
                                    value = field.value;

                                value = value.replace(':locale', this.booted.locale);

                                items[fieldKey] = {
                                    label: this.__('fields->' + fieldKey),
                                    value: this.booted.helpers.iterator.searchByPath(data, value),
                                    type: field.type,
                                    options: field.options ?? {},
                                };

                                if (items[fieldKey].options.onComplete) {
                                    items[fieldKey].value = items[fieldKey].options.onComplete(this, items[fieldKey].value);
                                }
                            }

                            break;
                        case 'form':
                            let fieldGroups = model.form;

                            for (let fieldGroupKey in fieldGroups) {
                                let fields = fieldGroups[fieldGroupKey];

                                items[fieldGroupKey] = {};

                                for (let fieldKey in fields) {
                                    let field = fields[fieldKey],
                                        name = fieldKey,
                                        value = this.booted.helpers.iterator.searchByPath(data, fieldKey),
                                        select2Value = field.select2Value;

                                    if (name.includes('.')) {
                                        name = name.split('.');
                                        name = name.shift() + '[' + name.join('][') + ']';
                                    }

                                    if (field.value) {
                                        value = field.value(value);
                                    }

                                    if (select2Value) {
                                        select2Value = select2Value.replace(':locale', this.booted.locale);
                                        select2Value = this.booted.helpers.iterator.searchByPath(data, select2Value);
                                    }

                                    items[fieldGroupKey][fieldKey] = {
                                        label: this.__('fields->' + (field.label ?? fieldKey)),
                                        name: name,
                                        value: value,
                                        select2Value: select2Value,
                                        type: field.type,
                                        options: field.options ?? {},
                                        wrapperSize: field.wrapperSize ?? crudEnums.wrapperSizes.lg,
                                    };
                                }
                            }

                            break;
                    }

                    this.items = items;
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