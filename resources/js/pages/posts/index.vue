<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';

defineProps(['posts']);

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Posts',
        href: '/posts',
    },
];

const postToDelete = ref();

const deletePost = () => {
    router.delete(route('posts.destroy', postToDelete.value), {
        preserveScroll: true,
        onSuccess: () => {
            postToDelete.value = undefined;
        },
    });
};
</script>
<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div>
            <pre> {{ posts }}</pre>
            <pre>{{}}</pre>
        </div>
    </AppLayout>
</template>
