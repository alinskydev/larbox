<script setup>
import * as Enums from '@/app/core/enums';

import Input from '@/app/components/Input.vue';
</script>

<script>
export default {
    inheritAttrs: false,
    props: {
        item: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            model: this.booted.components.current.config.model,
            fields: this.item.options.fields,
            items: [],
        };
    },
    created() {
        for (let key in this.item.value) {
            this.items[key] = {
                id: {
                    name: this.item.name + '[' + key + '][id]',
                    value: this.item.value[key].id,
                    type: Enums.inputTypes.hidden,
                },
                fields: this.model.prepareRelationsInputs(this, this.fields, this.item.value[key], this.item.name, key),
            };
        }
    },
    mounted() {
        $('#' + this.item.id + ' tbody').sortable({
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

            this.items.push({
                id: {
                    name: this.item.name + '[' + uniqueId + '][id]',
                    value: 0,
                    type: Enums.inputTypes.hidden,
                },
                fields: this.model.prepareRelationsInputs(this, this.fields, {}, this.item.name, uniqueId),
            });
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
        <table class="table table-hover table-bordered" :id="item.id">
            <tbody>
                <template v-for="(relationItem, key) in items">
                    <tr :data-key="key" class="crud-relation">
                        <td class="align-middle" style="width: 50px;">
                            <div class="btn btn-primary table-sorter">
                                <i class="fas fa-arrows-alt"></i>
                            </div>

                            <Input :item="relationItem.id" />
                        </td>

                        <td>
                            <div class="row">
                                <template v-for="field in relationItem.fields">
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