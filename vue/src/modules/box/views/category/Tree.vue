<script setup>
import { Page } from '@/core/page';
import { IndexConfig } from '@/core/crud/config';
import model from '@/modules/box/models/category';

import PageTitle from '@/components/blocks/PageTitle.vue';

import Tree from '@/components/nestedSet/Tree.vue';
import Create from './Create.vue';
import Show from './Show.vue';
import Update from './Update.vue';
</script>

<script>
export default {
    data() {
        return {
            page: new Page({
                context: this,
                title: this.__('routes->box.category'),
            }),
            config: new IndexConfig({
                model: model,
                http: {
                    path: 'box/category',
                },
            }),
            elementId: this.booted.helpers.string.uniqueElementId(),
            formType: 'create',
            formKey: 0,
            treeKey: 0,
        };
    },
    methods: {
        create() {
            this.formType = 'create';
            this.formKey++;

            $('#modal-' + this.elementId).modal('show');
        },
    },
};
</script>

<template>
    <PageTitle :text="page.title">
        <button
            v-if="booted.helpers.user.checkRoute(booted.components.app, 'box/category/create')"
            type="button"
            class="btn btn-success"
            @click="create"
        >
            {{ __('routeActions->create') }}
        </button>
    </PageTitle>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">
                {{ __('Данные') }}
            </h3>
        </div>

        <div class="card-body">
            <Tree httpPath="box/category" :elementId="elementId" :key="treeKey" />
        </div>

        <div class="modal fade" :id="'modal-' + elementId">
            <div class="modal-dialog modal-xl">
                <div class="modal-content" :key="formKey">
                    <Create v-if="formType === 'create'" :elementId="elementId" />
                    <Show v-else-if="formType === 'show'" :elementId="elementId" />
                    <Update v-else-if="formType === 'update'" :elementId="elementId" />
                </div>
            </div>
        </div>
    </div>
</template>
