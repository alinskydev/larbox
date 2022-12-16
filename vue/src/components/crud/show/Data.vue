<script setup>
import Value from '@/components/Value.vue';
</script>

<script>
export default {
    props: {
        items: {
            type: Object,
            required: true,
        },
    },
};
</script>

<template>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">
                {{ __('Данные') }}
            </h3>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <tbody>
                        <tr v-for="item in items">
                            <th v-if="item.label">
                                {{ item.label }}
                            </th>

                            <td :colspan="item.label ? 1 : 2">
                                <Value :item="item" :id="items.id.value" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
