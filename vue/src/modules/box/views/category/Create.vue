<script setup>
import { Page } from '@/core/page';
import { CreateConfig } from '@/core/crud/config';
import model from '@/modules/box/models/category';

import Buttons from '@/components/crud/form/particles/Buttons.vue';
import Create from '@/components/crud/Create.vue';
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
            config: new CreateConfig({
                model: model,
                http: {
                    path: 'box/category',
                },
                events: {
                    afterSubmit: (formData, response) => {
                        this.$parent.$data.treeKey++;
                        $('#' + this.id).modal('hide');
                        toastr.success(this.__('Сохранение прошло успешно'));
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
            {{ __('routeActions->create') }}
        </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <div class="modal-body">
        <Create />
    </div>

    <div class="modal-footer">
        <Buttons :actions="['save']" />
    </div>
</template>
