<script setup>
import { Page } from '@/app/core/page';
import PageTitle from '@/app/components/blocks/PageTitle.vue';
</script>

<script>
export default {
	data() {
		return new Page({
			context: this,
			title: this.__('Главная'),
			hideBreadcrumbs: true,
		});
	},
	created() {
		this.$data.init();
	},
};
</script>

<template>
	<PageTitle :text="title" />
</template>
