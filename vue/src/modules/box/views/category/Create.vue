<script setup>
import App from '@/core/app';
import Model from '@/modules/box/models/category';
import { CreateConfig } from '@/core/crud/configs';
import * as Enums from '@/core/enums';

import Create from '@/components/crud/Create.vue';
</script>

<script>
export default {
    props: {
        parentId: {
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
                        $('#modal-' + this.parentId).modal('hide');
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
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>

    <div class="modal-body">
        <Create
            :config="config"
            :actions="['save']"
            :data-layout="Enums.crudFormDataLayouts.accordions"
            :buttons-layout="Enums.crudFormButtonsLayouts.bottomStatic"
        />
    </div>
</template>
