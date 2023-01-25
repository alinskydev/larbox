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
    <div
        v-for="(items, key) in model.data.show"
        class="card card-primary mb-4"
        :set="(groupId = App.helpers.string.uniqueElementId())"
    >
        <div
            class="card-header d-flex align-items-center justify-content-between"
            role="button"
            data-bs-toggle="collapse"
            :data-bs-target="'#' + groupId"
        >
            <h3 class="card-title w-100">
                {{ App.t(key) }}
            </h3>
            <i class="fas fa-angle-down"></i>
        </div>

        <div :id="groupId" class="collapse show">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tbody>
                            <tr v-for="item in items">
                                <th v-if="item.label">
                                    {{ item.label }}
                                </th>

                                <td :colspan="item.label ? 1 : 2">
                                    <Value :item="item" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
