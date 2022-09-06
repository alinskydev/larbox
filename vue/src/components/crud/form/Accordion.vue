<script setup>
import Input from '@/components/Input.vue';
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
            let formData = new FormData(event.target);

            this.config.beforeSubmit(this, formData);

            this.booted.helpers.http
                .send(this, {
                    method: 'POST',
                    path: this.config.http.path,
                    query: {
                        _method: this.config.method,
                    },
                    body: formData,
                })
                .then((response) => {
                    if (response.statusType === 'success') {
                        this.config.afterSubmit(this, formData, response);

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
        <div
            v-for="(items, key) in itemGroups"
            class="card card-primary mb-3"
            :set="(groupId = 'el-' + booted.helpers.string.uniqueId())"
        >
            <div
                class="card-header d-flex align-items-center justify-content-between"
                role="button"
                data-toggle="collapse"
                :data-target="'#' + groupId"
            >
                <h3 class="card-title w-100">
                    {{ __(key) }}
                </h3>

                <i class="fas fa-angle-down"></i>
            </div>

            <div :id="groupId" class="collapse show">
                <div class="card-body">
                    <div class="row">
                        <template v-for="item in items">
                            <Input :item="item" />
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>
