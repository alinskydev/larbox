<script setup>
import { UpdateConfig } from '@/core/crud/configs';
import model from '@/modules/box/models/category';

import Buttons from '@/components/crud/form/Buttons.vue';
import Update from '@/components/crud/Update.vue';
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
            title: this.__('routeActions->update'),
            config: new UpdateConfig({
                model: model,
                http: {
                    path: 'box/category/:pk',
                },
                events: {
                    afterResponse: (data) => {
                        this.title += ': ' + data.name[this.booted.locale];
                    },
                    afterSubmit: (formData, response) => {
                        let text = formData.get('name[' + this.booted.locale + ']');

                        $('#tree-' + this.elementId)
                            .jstree(true)
                            .rename_node(this.$route.params.pk, text);

                        $('#modal-' + this.elementId).modal('hide');

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
            {{ title }}
        </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <div class="modal-body">
        <Update :config="config" />
    </div>

    <div class="modal-footer">
        <Buttons :actions="['save']" />
    </div>
</template>
