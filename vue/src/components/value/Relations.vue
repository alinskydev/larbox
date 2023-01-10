<script setup>
import Value from '@/components/Value.vue';
</script>

<script>
export default {
    props: {
        item: {
            type: Object,
            required: true,
        },
    },
};
</script>

<template>
    <div v-if="item.value.length > 0" class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr class="bg-info">
                    <th style="width: 30px">№</th>
                    <th v-for="relationItem in item.value[0]">
                        {{ relationItem.label }}
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="(relationItem, key) in item.value">
                    <td>{{ parseInt(key) + 1 }}</td>

                    <td v-for="relationField in relationItem">
                        <Value :item="relationField" />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
