<script setup>
import * as Enums from '@/core/enums';
</script>

<script>
export default {
    props: {
        routeAll: {
            type: String,
            required: true,
        },
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
    <th style="width: 30px">
        <input
            type="checkbox"
            name="routes[]"
            :value="routeAll"
            :checked="value.includes(routeAll)"
            class="checkbox-lg"
            data-level="2"
            @change="toggle"
        />
    </th>

    <th>
        <label>
            {{ label }}
        </label>
    </th>

    <td>
        <div class="row">
            <div v-for="(route, key) in routes" :class="Enums.inputSizes.xs + ' py-1'">
                <div class="form-check">
                    <label class="form-check-label">
                        <input
                            type="checkbox"
                            name="routes[]"
                            :value="route"
                            class="form-check-input"
                            :checked="value.includes(route) || value.includes(routeAll)"
                            data-level="3"
                            @change="toggle"
                        />

                        {{ __('routeActions->' + key) }}
                    </label>
                </div>
            </div>
        </div>
    </td>
</template>
