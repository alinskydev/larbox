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
            let http = this.config.http,
                formData = new FormData(event.target);

            this.config.events.beforeSubmit(this, formData);

            this.booted.helpers.http
                .send(this, {
                    method: 'POST',
                    path: http.path,
                    query: {
                        ...http.query,
                        ...{
                            _method: http.method,
                        },
                    },
                    body: formData,
                })
                .then((response) => {
                    if (response.statusType === 'success') {
                        this.config.events.afterSubmit(this, formData, response);
                    }
                });
        },
    },
};
</script>

<template>
    <form @submit.prevent="submit" id="crud-form">
        <div v-for="(items, key) in itemGroups" class="card card-primary mb-3" :set="(groupId = 'el-' + booted.helpers.string.uniqueId())">
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
