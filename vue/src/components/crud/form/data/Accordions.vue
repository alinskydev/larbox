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
        elementId: {
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
    <form @submit.prevent="$parent.$data.submit" :id="elementId" class="crud-form d-inline-block w-100">
        <div v-for="(items, key, index) in model.data.form" class="accordion card">
            <button
                class="accordion-button card-header"
                type="button"
                data-bs-toggle="collapse"
                :data-bs-target="'#accordion-' + elementId + '-' + index"
            >
                {{ App.t(key) }}
            </button>

            <div :id="'accordion-' + elementId + '-' + index" class="collapse show">
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
