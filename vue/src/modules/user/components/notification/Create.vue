<script setup>
import App from '@/core/app';
import Form from '@/modules/user/forms/notification';

import Input from '@/components/Input.vue';
</script>

<script>
export default {
    data() {
        return {
            elementId: App.helpers.string.uniqueElementId(),
            inputs: Form.fillData().data.form[0],
        };
    },
    methods: {
        submit(event) {
            let formData = new FormData(event.target);

            formData.append('user_query', location.search);

            App.helpers.http
                .send({
                    method: 'POST',
                    path: 'user/notification',
                    body: formData,
                })
                .then((response) => {
                    if (response.statusType === 'success') {
                        toastr.success(App.t('Уведомление будет отправлено в ближайшее время'));

                        $('#' + this.elementId).modal('hide');
                        $('#user-notification-create-form [name="text"]').val('');
                    }
                });
        },
    },
};
</script>

<template>
    <button type="button" class="btn btn-warning" data-bs-toggle="modal" :data-bs-target="'#' + elementId">
        {{ App.t('Отправка уведомления') }}
    </button>

    <div class="modal fade" :id="elementId">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submit" id="user-notification-create-form">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            {{ App.t('Отправка уведомления') }}
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <Input :item="inputs.type" />
                        <Input :item="inputs.text" />
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary w-100" form="user-notification-create-form">
                            {{ App.t('Отправить') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
