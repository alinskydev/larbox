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
        class="accordion card mb-4"
        :set="(groupId = App.helpers.string.uniqueElementId())"
    >
        <button class="accordion-button card-header" type="button" data-bs-toggle="collapse" :data-bs-target="'#' + groupId">
            {{ App.t(key) }}
        </button>

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
