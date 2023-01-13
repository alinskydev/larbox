<script setup>
import App from '@/core/app';
import Model from '@/modules/box/models/category';
import { CreateConfig } from '@/core/crud/configs';

import Buttons from '@/components/crud/form/Buttons.vue';
import Create from '@/components/crud/Create.vue';
</script>

<script>
export default {
    props: {
        elementId: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            title: App.t('routeActions->create'),
            config: new CreateConfig({
                model: Model,
                http: {
                    path: 'box/category',
                },
                events: {
                    afterSubmit: (formData, response) => {
                        this.$parent.$data.treeKey++;
                        $('#modal-' + this.elementId).modal('hide');
                        toastr.success(App.t('Сохранение прошло успешно'));
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
            {{ title }}
        </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <div class="modal-body">
        <Create :config="config" />
    </div>

    <div class="modal-footer">
        <Buttons :actions="['save']" />
    </div>
</template>
