<script setup>
import * as crudEnums from '@/app/core/crud/enums';

import Input from '@/app/components/crud/particles/Input.vue';
</script>

<script>
export default {
    inheritAttrs: false,
    props: {
        namePrefix: {
            type: String,
            required: true,
        },
        relations: {
            type: Array,
            default: [],
        },
        options: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            id: 'input-' + this.booted.helpers.string.uniqueId(),
            fields: this.options.fields,
            items: [],
        };
    },
    created() {
        let items = [];

        for (let relationKey in this.relations) {
            let relation = this.relations[relationKey];

            items[relationKey] = {
                id: {
                    name: this.namePrefix + '[' + relationKey + '][id]',
                    value: relation.id,
                    type: crudEnums.inputTypes.hidden,
                },
                fields: {},
            };

            for (let fieldKey in this.fields) {
                let field = this.fields[fieldKey],
                    name = fieldKey,
                    value = this.booted.helpers.iterator.searchByPath(relation, fieldKey),
                    select2Value = field.select2Value;

                if (field.value) {
                    value = field.value(value);
                }

                if (select2Value) {
                    select2Value = select2Value.replace(':locale', this.booted.locale);
                    select2Value = this.booted.helpers.iterator.searchByPath(relation, select2Value);
                }

                items[relationKey]['fields'][fieldKey] = {
                    label: this.__('fields->' + fieldKey),
                    name: this.namePrefix + '[' + relationKey + '][' + name + ']',
                    value: value,
                    select2Value: select2Value,
                    type: field.type,
                    options: field.options ?? {},
                    size: field.size ?? crudEnums.inputSizes.lg,
                };
            }
        }

        this.items = items;
    },
    mounted() {
        $('#' + this.id + ' tbody').sortable({
            handle: '.table-sorter',
            placeholder: 'sortable-placeholder',
            start: function (event, ui) {
                ui.placeholder.height(ui.helper.outerHeight());
            }
        });
    },
    methods: {
        add() {
            let uniqueId = this.booted.helpers.string.uniqueId();

            let item = {
                id: {
                    name: this.namePrefix + '[' + uniqueId + '][id]',
                    value: 0,
                    type: crudEnums.inputTypes.hidden,
                },
                fields: {},
            };

            for (let fieldKey in this.fields) {
                let field = this.fields[fieldKey];

                item['fields'][fieldKey] = {
                    label: this.__('fields->' + fieldKey),
                    name: this.namePrefix + '[' + uniqueId + '][' + fieldKey + ']',
                    type: field.type,
                    options: field.options ?? {},
                    size: field.size ?? crudEnums.inputSizes.lg,
                };
            }

            this.items.push(item);
        },
        remove(event) {
            let $row = $(event.target).closest('tr');
            $row.remove();
        },
    },
};
</script>

<template>
    <div class="table-responsive">
        <table class="table table-hover table-bordered" :id="id">
            <tbody>
                <template v-for="(item, key) in items">
                    <tr :data-key="key" class="crud-relation">
                        <td class="align-middle" style="width: 50px;">
                            <div class="btn btn-primary table-sorter">
                                <i class="fas fa-arrows-alt"></i>
                            </div>

                            <Input :item="item.id" />
                        </td>

                        <td>
                            <div class="row">
                                <template v-for="field in item.fields">
                                    <Input :item="field" />
                                </template>
                            </div>
                        </td>

                        <td style="width: 50px;">
                            <button type="button" @click="remove" class="btn btn-danger">
                                <i class="fas fa-times"></i>
                            </button>
                        </td>
                    </tr>
                </template>
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="3">
                        <button type="button" @click="add" class="btn btn-success btn-block">
                            <i class="fas fa-plus"></i>
                        </button>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</template>