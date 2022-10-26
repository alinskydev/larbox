<script setup>
import { Page } from '@/core/page';
import { UpdateConfig } from '@/core/crud/config';
import model from '@/modules/box/models/category';

import Buttons from '@/components/crud/form/particles/Buttons.vue';
import Update from '@/components/crud/Update.vue';
</script>

<script>
export default {
    props: {
        id: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('routes->box.category'),
            }),
            config: new UpdateConfig({
                model: model,
                http: {
                    path: 'box/category/:id',
                },
                events: {
                    afterSubmit: (context, formData, response) => {
                        this.$parent.$data.treeKey++;
                        $('#' + this.id).modal('hide');
                        toastr.success(context.__('Сохранение прошло успешно'));
                    },
                },
            }),
        };
    },
};
</script>

<template>
    <div class="modal-header">
        <h4 class="modal-title">
            {{ __('routeActions->update') }}
        </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <div class="modal-body">
        <Update />
    </div>

    <div class="modal-footer justify-content-between">
        <Buttons :actions="['save']" />
    </div>
</template>
