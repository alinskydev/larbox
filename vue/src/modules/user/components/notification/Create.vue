<script setup>
import form from '@/modules/user/forms/notification';
import Input from '@/components/Input.vue';
</script>

<script>
export default {
    data() {
        return {
            id: 'el-' + this.booted.helpers.string.uniqueId(),
            inputs: form.prepareInputs(this, form.form[0]),
        };
    },
    methods: {
        submit(event) {
            let formData = new FormData(event.target);

            formData.append('user_query', location.search);

            this.booted.helpers.http
                .send(this, {
                    method: 'POST',
                    path: 'user/notification',
                    body: formData,
                })
                .then((response) => {
                    if (response.statusType === 'success') {
                        toastr.success(this.__('Уведомление будет отправлено в ближайшее время'));

                        $('#' + this.id).modal('hide');
                        $('#user-notification-create-form [name="message"]').val('');
                    }
                });
        },
    },
};
</script>

<template>
    <button type="button" class="btn btn-warning" data-toggle="modal" :data-target="'#' + id">
        {{ __('Отправка уведомления') }}
    </button>

    <div class="modal fade" :id="id">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form @submit.prevent="submit" id="user-notification-create-form">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            {{ __('Отправка уведомления') }}
                        </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <Input :item="inputs.type" />
                        <Input :item="inputs.message" />
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-block" form="user-notification-create-form">
                            {{ __('Отправить') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
