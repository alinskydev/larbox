<script setup>
import Routes from './Tree/Routes.vue';
</script>

<script>
export default {
    props: {
        prefix: {
            type: String,
            required: true,
        },
        value: {
            type: Array,
            default: [],
        },
    },
    data() {
        return {
            routes: this.booted.enums.user.role.routes.tree.admin,
        };
    },
};
</script>

<template>
    <div class="col-12">
        <table class="table table-bordered">
            <template v-for="(routes1, routes1Key) in routes">
                <thead>
                    <tr class="table-info">
                        <th colspan="3">
                            <h6 class="text-center font-weight-bold m-0">
                                {{ __('routes->' + routes1Key) }}
                            </h6>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <template v-if="typeof Object.values(routes1)[0] === 'object'">
                        <tr v-for="(routes2, routes2Key) in routes1">
                            <Routes
                                :routeAll="prefix + '.' + routes1Key + '.' + routes2Key + '.*'"
                                :label="__('routes->' + routes1Key + '.' + routes2Key)"
                                :routes="routes2"
                                :value="value"
                            />
                        </tr>
                    </template>

                    <template v-else>
                        <tr>
                            <Routes
                                :routeAll="prefix + '.' + routes1Key + '.*'"
                                :label="__('routes->' + routes1Key)"
                                :routes="routes1"
                                :value="value"
                            />
                        </tr>
                    </template>
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="3" class="bg-white"></td>
                    </tr>
                </tfoot>
            </template>
        </table>
    </div>
</template>
