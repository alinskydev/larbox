<script setup>
import { Page } from '@/app/core/page';
import { UpdateConfig } from '@/app/core/crud/config';
import model from '@/modules/user/models/user';

import PageTitle from '@/app/components/blocks/PageTitle.vue';
import Buttons from '@/app/components/crud/form/_Buttons.vue';
import Item from '@/app/components/crud/http/Item.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('Редактирование'),
                breadcrumbs: [
                    {
                        label: this.__('Пользователи'),
                        path: 'user/user',
                    },
                ],
            }),
            config: new UpdateConfig({
                model: model,
                http: {
                    path: 'user/user/:id',
                },
                titleField: 'username',
                redirectPath: 'user/user',
                afterSubmit: (context, form, responseBody) => {
                    toastr.success(context.__('Запись успешно сохранена'));

                    if (this.$route.params.id == this.booted.user.id) {
                        if (form.new_password) {
                            this.booted.helpers.user.login(this, form.username, form.new_password);
                        }

                        context.booted.components.app.childKey++;
                    }
                },
            }),
        };
    },
};
</script>

<template>
    <PageTitle :text="page.title">
        <Buttons />
    </PageTitle>

    <Item child="form" />
</template>
