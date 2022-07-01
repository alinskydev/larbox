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
            config: this.booted.components.current.config,
        };
    },
    methods: {
        submit(event) {
            let formData = new FormData(event.target),
                serializedForm = {};

            formData.forEach((value, key) => {
                serializedForm[key] = value;
            });

            this.config.beforeSubmit(this, serializedForm);

            this.booted.helpers.http.send(this, {
                method: 'POST',
                path: this.config.http.path,
                query: {
                    '_method': this.config.method,
                },
                body: formData,
            }).then((response) => {
                if (response.statusType === 'success') {
                    this.config.afterSubmit(this, serializedForm, response.data);

                    this.$router.push({
                        path: '/' + this.booted.locale + '/' + this.config.redirectPath,
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