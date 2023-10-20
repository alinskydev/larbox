<script setup>
import App from '@/core/app';
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
            routes: [],
        };
    },
    mounted() {
        App.helpers.http
            .send({
                method: 'GET',
                path: 'user/role/available-routes',
            })
            .then((response) => {
                if (response.statusType === 'success') {
                    this.routes = response.data.admin;
                }
            });
    },
};
</script>

<template>
    <div class="col-12">
        <table class="table table-bordered">
            <template v-for="(routes1, routes1Key) in routes">
                <tbody>
                    <tr class="bg-primary text-white">
                        <th colspan="3">
                            <div class="text-center font-size-16 font-weight-bold m-0">
                                {{ App.t('routes->' + routes1Key) }}
                            </div>
                        </th>
                    </tr>

                    <tr v-for="(routes2, routes2Key) in routes1">
                        <template v-if="typeof routes2 === 'object'">
                            <Routes
                                :label="App.t('routes->' + routes1Key + '.' + routes2Key)"
                                :routes="routes2"
                                :value="value"
                                :routeAsterisk="prefix + '.' + routes1Key + '.' + routes2Key + '.*'"
                            />
                        </template>

                        <template v-else>
                            <Routes
                                :label="App.t('routeActions->' + routes2Key)"
                                :routes="{}"
                                :value="value"
                                :routeAsterisk="prefix + '.' + routes1Key + '.' + routes2Key"
                            />
                        </template>
                    </tr>

                    <tr>
                        <td colspan="3" style="border-color: transparent"></td>
                    </tr>
                </tbody>
            </template>
        </table>
    </div>
</template>
