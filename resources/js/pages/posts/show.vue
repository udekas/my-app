<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';

defineProps(['post']);
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Show posts',
        href: '/posts/show',
    },
];
</script>
<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mx-auto my-12 w-full max-w-2xl">Show</div>
        <div class="mx-auto my-12 w-full max-w-2xl">
            <h1 class="text-2xl font-bold">{{ post.title }}</h1>
            <p class="mt-4 text-gray-600 dark:text-gray-400">{{ post.description }}</p>
        </div>
        <div class="mt-8">
            <form @submit.prevent="submit">
                <div class="relative">
                    <Textarea class="h-full w-full"> </Textarea>
                    <Button class="absolute bottom-4 right-4 z-10">Submit</Button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
