<script setup>
import Input from '@/app/components/Input.vue';
</script>

<script>
export default {
    props: {
        itemGroups: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            page: this.booted.components.page,
        };
    },
    methods: {
        submit(event) {
            let formData = new FormData(event.target),
                serializedForm = {};

            formData.forEach((value, key) => {
                serializedForm[key] = value;
            });

            this.page.beforeSubmit(this.page, serializedForm);

            this.booted.helpers.http.send(this, {
                method: 'POST',
                path: this.page.http.path,
                query: {
                    '_method': this.page.http.method,
                },
                body: formData,
            }).then((response) => {
                if (response.statusType === 'success') {
                    response.json().then((body) => {
                        this.page.afterSubmit(this.page, serializedForm, body);

                        this.$router.push({
                            path: '/' + this.booted.locale + '/' + this.page.redirectPath,
                        });
                    });
                } else if (response.statusType === 'validationFailed') {
                    response.json().then((body) => {
                        toastr.warning(body.message);

                        $('.input-error').addClass('d-none');

                        for (let key in body.errors) {
                            let error = body.errors[key].join("\n"),
                                altKey = null;

                            if (key.includes('.')) {
                                altKey = key.slice(0, key.lastIndexOf('.')) + '.*';
                            } else {
                                altKey = key + '.*';
                            }

                            $('[data-error-key="' + key + '"], [data-error-key="' + altKey + '"]')
                                .closest('.input-wrapper')
                                .find('.input-error')
                                .text(error)
                                .removeClass('d-none');
                        }
                    });
                }
            });
        },
    },
};
</script>

<template>
    <form @submit.prevent="submit" id="crud-form">
        <div v-for="(items, itemGroupKey) in itemGroups" class="card card-primary mb-3">
            <div class="card-header">
                <h3 class="card-title">
                    {{ __(itemGroupKey) }}
                </h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <template v-for="(item, itemKey) in items">
                        <Input :item="item" />
                    </template>
                </div>
            </div>
        </div>
    </form>
</template>