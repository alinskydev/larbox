<script setup>
import App from '@/core/app';
import Page from '@/core/page';
import Model from '@/modules/box/models/category';
import { IndexConfig } from '@/core/crud/configs';

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
            title: App.t('routes->box.category'),
            config: new IndexConfig({
                model: Model,
                http: {
                    path: 'box/category',
                },
            }),
            elementId: App.helpers.string.uniqueElementId(),
            modalView: 'create',
            modalKey: 0,
            treeKey: 0,
        };
    },
    created() {
        Page.init({
            title: this.title,
        });
    },
    methods: {
        create() {
            this.modalView = 'create';
            this.modalKey++;

            $('#modal-' + this.elementId).modal('show');
        },
    },
};
</script>

<template>
    <PageTitle :text="title">
        <button
            v-if="App.helpers.user.checkRoute('box/category/create')"
            type="button"
            class="btn btn-primary"
            @click="create"
        >
            {{ App.t('routeActions->create') }}
        </button>
    </PageTitle>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title m-0">
                {{ App.t('Данные') }}
            </h3>
        </div>

        <div class="card-body">
            <Tree httpPath="box/category" :elementId="elementId" :key="treeKey" />
        </div>

        <div class="modal fade" :id="'modal-' + elementId">
            <div class="modal-dialog modal-xl">
                <div class="modal-content" :key="modalKey">
                    <Create v-if="modalView === 'create'" :elementId="elementId" />
                    <Show v-else-if="modalView === 'show'" :elementId="elementId" />
                    <Update v-else-if="modalView === 'update'" :elementId="elementId" />
                </div>
            </div>
        </div>
    </div>
</template>
