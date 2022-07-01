<script setup>
import { Page } from '@/app/core/page';
import { UpdateConfig } from '@/app/core/crud/config';
import model from '@/modules/user/models/profile';

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
                title: this.__('Профиль'),
                breadcrumbs: [
                    {
                        label: this.__('Boxes'),
                        path: 'box/box',
                    },
                ],
            }),
            config: new UpdateConfig({
                model: model,
                http: {
                    path: 'user/profile',
                },
                redirectPath: 'user/profile',
                afterSubmit: (context, form, responseBody) => {
                    toastr.success(context.__('Профиль успешно сохранён'));

                    if (form.new_password) {
                        this.booted.helpers.user.login(this, form.username, form.new_password);
                    }

                    context.booted.components.app.childKey++;
                },
            }),
        };
    },
};
</script>

<template>
    <PageTitle :text="page.title">
        <Buttons :actions="['save']" />
    </PageTitle>

    <Item child="form" />
</template>
