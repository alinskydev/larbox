<script setup>
import App from '@/core/app';
import Value from '@/components/Value.vue';
</script>

<script>
export default {
    props: {
        model: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {};
    },
};
</script>

<template>
    <div v-for="(items, key, index) in model.data.show" class="accordion card">
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
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tbody>
                            <template v-for="item in items">
                                <tr v-if="!item.isHidden">
                                    <th v-if="item.label">
                                        {{ item.label }}
                                    </th>

                                    <td :colspan="item.label ? 1 : 2">
                                        <Value :item="item" />
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
