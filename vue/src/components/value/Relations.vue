<script setup>
import { Model } from '@/core/model';
import Value from '@/components/Value.vue';
</script>

<script>
export default {
    props: {
        item: {
            type: Object,
            required: true,
        },
        id: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            model: new Model({}),
            fields: {},
            items: {},
        };
    },
    created() {
        this.fields = this.model.prepareFields(this, this.item.options.relations);

        for (let key in this.item.value) {
            this.items[key] = this.model.prepareValues(this, this.item.options.relations, this.item.value[key]);
        }
    },
};
</script>

<template>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr class="bg-info">
                    <th style="width: 30px">№</th>
                    <th v-for="field in fields">
                        {{ field.label }}
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="(relationItem, relationItemKey) in items">
                    <td>{{ parseInt(relationItemKey) + 1 }}</td>

                    <td v-for="(field, fieldKey) in fields">
                        <Value :item="relationItem[fieldKey]" :id="id" />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
