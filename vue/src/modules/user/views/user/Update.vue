<script setup>
import { UpdatePage } from '@/app/core/crud/page';
import model from '@/modules/user/models/user';

import PageTitle from '@/app/components/blocks/PageTitle.vue';
import Buttons from '@/app/components/crud/form/_Buttons.vue';
import Item from '@/app/components/crud/http/Item.vue';
</script>

<script>
export default {
    data() {
        return new UpdatePage({
            context: this,
            title: this.__('Редактирование'),
            titleField: 'username',
            breadcrumbs: [
                {
                    label: this.__('Пользователи'),
                    path: 'user/user',
                },
            ],
            model: model,
            http: {
                method: 'PATCH',
                path: 'user/user/:id',
            },
            redirectPath: 'user/user',
            afterSubmit: (context, form, responseBody) => {
                toastr.success(context.__('Запись успешно сохранена'));

                if (this.$route.params.id == this.booted.user.id) {
                    if (form.new_password) {
                        this.booted.helpers.user.login(this, form.username, form.new_password);
                    }

                    context.booted.components.app.$data.childKey++;
                }
            },
        });
    },
};
</script>

<template>
    <PageTitle :text="title">
        <Buttons />
    </PageTitle>

    <Item child="form" />
</template>
