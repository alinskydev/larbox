<script setup>
import { Page } from '@/core/page';
import { IndexConfig } from '@/core/crud/config';
import model from '@/modules/user/models/notification';

import PageTitle from '@/components/blocks/PageTitle.vue';
import Index from '@/components/crud/Index.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('routes->user.notification'),
            }),
            config: new IndexConfig({
                model: model,
                http: {
                    path: 'user/notification',
                },
                grid: {
                    actions: ['link', 'show'],
                    customActions: {
                        link: (record) => {
                            let path;

                            switch (record.type) {
                                case 'feedback_callback_created':
                                    path = 'feedback/callback/' + record.params.id + '/show';
                                    break;

                                default:
                                    return null;
                            }

                            return {
                                path: path,
                                linkAttributes: {
                                    title: this.__('Ссылка'),
                                    class: 'btn btn-info',
                                    target: '_blank',
                                },
                                iconAttributes: {
                                    class: 'fas fa-external-link-alt',
                                },
                            };
                        },
                    },
                    rowAttributes: (context, record) => {
                        if (!record.is_seen) {
                            return {
                                class: 'table-warning',
                            };
                        }
                    },
                },
            }),
        };
    },
    methods: {
        seeAll() {
            if (confirm(this.__('Вы уверены?'))) {
                this.booted.helpers.http
                    .send(this, {
                        method: 'PATCH',
                        path: 'user/notification/see-all',
                    })
                    .then((response) => {
                        if (response.statusType === 'success') {
                            toastr.success(this.__('Операция прошла успешно'));
                            this.booted.components.app.childKey++;
                        }
                    });
            }
        },
    },
};
</script>

<template>
    <PageTitle :text="page.title">
        <button type="button" @click="seeAll" class="btn btn-warning">
            {{ __('Отметить все как просмотренные') }}
        </button>
    </PageTitle>

    <Index />
</template>
