<script setup>
import Value from '@/app/components/crud/particles/Value.vue';
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
                            <template v-if="item.value !== undefined">
                                <th>
                                    {{ item.options.hideLabel ? '' : item.label }}
                                </th>

                                <td>
                                    <Value :item="item" :id="items.id.value" />
                                </td>
                            </template>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>