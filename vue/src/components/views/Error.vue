<script setup>
import App from '@/core/app';
</script>

<script>
export default {
    data() {
        return {
            title: App.t('Ошибка'),
        };
    },
    created() {
        document.title = this.title;
    },
};
</script>

<template>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="card-body pt-0">
                            <div class="ex-page-content text-center">
                                <h1 class="text-dark">404!</h1>
                                <h3 class="mb-4">
                                    {{ App.t('Страница не найдена') }}
                                </h3>

                                <a href="/" class="btn btn-primary mb-4">
                                    <i class="mdi mdi-home"></i>
                                    {{ App.t('На главную') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
