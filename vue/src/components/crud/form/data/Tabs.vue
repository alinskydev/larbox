<script setup>
import App from '@/core/app';
import Input from '@/components/Input.vue';
</script>

<script>
export default {
    props: {
        model: {
            type: Object,
            required: true,
        },
        parentId: {
            type: String,
            required: true,
        },
    },
    data() {
        return {};
    },
};
</script>

<template>
    <form @submit.prevent="$parent.$data.submit" :id="parentId" class="crud-form d-inline-block w-100 mt-4">
        <div class="row">
            <div class="col-xxl-2 col-xl-3">
                <div class="card m-0">
                    <ul class="nav nav-pills flex-column" role="tablist">
                        <li v-for="(items, key, index) in model.data.form" class="nav-item">
                            <a
                                data-bs-toggle="tab"
                                :href="'#tab-' + parentId + '-' + index"
                                :class="'nav-link font-size-16' + (!index ? ' active' : '')"
                                role="tab"
                            >
                                {{ App.t(key) }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-xxl-10 col-xl-9">
                <div class="card m-0">
                    <div class="tab-content">
                        <div
                            v-for="(items, key, index) in model.data.form"
                            :id="'tab-' + parentId + '-' + index"
                            :class="'tab-pane card-body' + (!index ? ' active' : '')"
                            role="tabpanel"
                        >
                            <div class="row">
                                <template v-for="item in items">
                                    <Input :item="item" />
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>
