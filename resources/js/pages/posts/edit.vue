<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import Button from '@/components/ui/button/Button.vue';
import Card from '@/components/ui/card/Card.vue';
import CardContent from '@/components/ui/card/CardContent.vue';
import CardDescription from '@/components/ui/card/CardDescription.vue';
import CardFooter from '@/components/ui/card/CardFooter.vue';
import CardHeader from '@/components/ui/card/CardHeader.vue';
import CardTitle from '@/components/ui/card/CardTitle.vue';
import Input from '@/components/ui/input/Input.vue';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { useForm } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create posts',
        href: '/posts/create',
    },
];
const form = useForm({
    title: '',
    description: '',
});
const submit = () => {
    form.post(route('posts.store'),)
}
</script>
<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="my-12 w-full mx-auto max-w-2xl">
            <form @submit.prevent="submit">
             <Card>
               <CardHeader>
                 <CardTitle>Edit post</CardTitle>
                 <CardDescription>Edit blog post</CardDescription>
               </CardHeader>
               <CardContent class="flex flex-col gap-4">
                 <div>
                    <label>Title</label>
                    <Input v-model="form.title">
                    </Input>
                    <InputError :message="form.errors.title"
                    </InputError>
                 </div>
                 <div>
                    <label>Description</label>
                    <Textarea v-model="form.description"></Textarea>
                    <InputError :message="form.errors.description"
                    </InputError>
                 </div>
               </CardContent>

               <CardFooter>
                 <Button type="submit">Submit</Button>
               </CardFooter>
             </Card>
             </form>
        </div>
        
    </AppLayout>
</template>