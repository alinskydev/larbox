<script setup>
import { Page } from '@/app/core/page';
import { IndexConfig } from '@/app/core/crud/config';
import model from '@/modules/user/models/notification';

import PageTitle from '@/app/components/blocks/PageTitle.vue';
import RouterLink from '@/app/components/blocks/RouterLink.vue';
import Index from '@/app/components/crud/Index.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('Уведомления'),
            }),
            config: new IndexConfig({
                model: model,
                http: {
                    path: 'user/notification',
                },
                actions: ['show'],
                gridRowAttributes: (item) => {
                    if (!item.is_seen.value) {
                        return {
                            class: 'table-warning',
                        };
                    }
                },
            }),
        };
    },
    methods: {
        seeAll() {
            this.booted.helpers.http
                .send(this, {
                    method: 'PUT',
                    path: 'user/notification/see-all',
                })
                .then((response) => {
                    if (response.statusType === 'success') {
                        toastr.success(this.__('Операция прошла успешно'));
                        this.booted.components.app.childKey++;
                    }
                });
        },
    },
};
</script>

<template>
    <PageTitle :text="page.title"> 
        <button type="button" @click="seeAll" class="btn btn-warning">
            {{__('Отметить все как просмотренные')}}
        </button>
    </PageTitle>

    <Index />
</template>
