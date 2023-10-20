<script setup>
import App from '@/core/app';
import * as Enums from '@/core/enums';
</script>

<script>
export default {
    props: {
        label: {
            type: String,
            required: true,
        },
        routes: {
            type: Object,
            required: true,
        },
        value: {
            type: Array,
            default: [],
        },
        routeAsterisk: {
            type: String,
        },
    },
    data() {
        return {};
    },
    mounted() {
        let $row = $(this.$el).closest('tr'),
            totalCount = $row.find('input[type="checkbox"][data-level="3"]').length,
            checkedCount = $row.find('input[type="checkbox"][data-level="3"]:checked').length;

        $row.find('input[type="checkbox"][data-level="2"]').prop('checked', checkedCount === totalCount);
    },
    methods: {
        toggle(event) {
            let $el = $(event.target),
                $row = $el.closest('tr'),
                isChecked = $el.prop('checked');

            switch (parseInt($el.data('level'))) {
                case 2:
                    $row.find('input[type="checkbox"][data-level="3"]').prop('checked', isChecked);
                    break;
                case 3:
                    let totalCount = $row.find('input[type="checkbox"][data-level="3"]').length,
                        checkedCount = $row.find('input[type="checkbox"][data-level="3"]:checked').length;

                    $row.find('input[type="checkbox"][data-level="2"]').prop('checked', checkedCount === totalCount);
                    break;
            }
        },
    },
};
</script>

<template>
    <th class="p-3 align-middle" style="width: 30px">
        <div class="form-check">
            <input
                type="checkbox"
                name="routes[]"
                :value="routeAsterisk"
                :checked="value.includes(routeAsterisk)"
                class="form-check-input"
                data-level="2"
                @change="toggle"
            />
        </div>
    </th>

    <th class="p-3 text-center align-middle">
        {{ label }}
    </th>

    <td class="py-0">
        <div class="row">
            <div v-for="(route, key) in routes" :class="Enums.inputSizes.sm + ' p-3'">
                <div class="form-check">
                    <input
                        type="checkbox"
                        name="routes[]"
                        :value="route"
                        class="form-check-input"
                        :checked="value.includes(route) || value.includes(routeAsterisk)"
                        data-level="3"
                        @change="toggle"
                    />

                    <span class="ms-2">
                        {{ App.t('routeActions->' + key) }}
                    </span>
                </div>
            </div>
        </div>
    </td>
</template>
