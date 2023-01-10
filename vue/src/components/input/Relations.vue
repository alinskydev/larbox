<script setup>
import * as Enums from '@/core/enums';

import { Model } from '@/core/model';
import Input from '@/components/Input.vue';
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
            model: new Model({}),
            fields: this.item.options.relations,
            items: this.item.value,
        };
    },
    mounted() {
        this.fields.id;

        $('#' + this.item.elementId + ' tbody').sortable({
            handle: '.table-sorter',
            placeholder: 'sortable-placeholder',
            start: function (event, ui) {
                ui.placeholder.height(ui.helper.outerHeight());
            },
        });
    },
    methods: {
        add() {
            console.log(this.fields);
            let uniqueId = this.booted.helpers.string.uniqueId();

            let model = new Model({
                hasUpdatedAtConflictCheck: false,
                config: {
                    form: {
                        0: {
                            relations: {
                                name: this.item.name,
                                type: Enums.inputTypes.relations,
                                options: {
                                    relations: this.item.options.relations,
                                },
                            },
                        },
                    },
                },
            });

            let newData = { relations: [{ id: uniqueId }] };

            model.fillData(this, newData);

            this.items.push(model.data.form[0].relations.value[0]);

            // console.log(this.items);
            console.log(model.data.form[0]);
        },
        remove(event) {
            $(event.target).closest('tr').remove();
        },
        toggleSort(isEnabled) {
            $('#' + this.item.elementId + ' .btn-sort-toggler').toggleClass('d-none');

            $('#' + this.item.elementId + ' .inputs').each(function () {
                let $els = $(this).children().not(':first');
                isEnabled ? $els.addClass('d-none') : $els.removeClass('d-none');
            });
        },
    },
};
</script>

<template>
    <div class="col-12" :id="item.elementId">
        <div class="card card-info mb-3">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title w-100">
                    {{ item.label }}
                </h3>

                <div class="btn-group">
                    <button type="button" class="btn btn-light btn-sort-toggler" @click="toggleSort(true)">
                        <i class="fas fa-arrows-alt"></i>
                    </button>
                    <button type="button" class="btn btn-light btn-sort-toggler d-none" @click="toggleSort(false)">
                        <i class="fas fa-edit"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <tbody>
                            <template v-for="(relationItem, key) in items">
                                <tr :data-key="key" class="crud-relation">
                                    <td class="align-middle" style="width: 50px">
                                        <div class="btn btn-primary table-sorter">
                                            <i class="fas fa-arrows-alt"></i>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="inputs row">
                                            <template v-for="field in relationItem">
                                                <Input :item="field" />
                                            </template>
                                        </div>
                                    </td>

                                    <td style="width: 50px">
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
            </div>
        </div>
    </div>
</template>
