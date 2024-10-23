<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from "@inertiajs/vue3";
import { defineProps } from 'vue';

// Принимаем пост через пропсы
const props = defineProps({
    post: Object
});

const form = useForm({});

const deletePost = (id) => {
    form.delete(`${id}`);
};


</script>

<template>
    <Head title="Manage Defects" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Defect Details</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <Link href="/posts">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Back</button>
                        </Link>
                        
                        
                        <h1 class="text-2xl font-bold mb-4">{{ post.title }}</h1>

                        
                        <p class="text-gray-500">
                            Device: <strong>{{ post.category.title }}</strong>
                        </p>

                        <p class="text-gray-500">
                            User: <strong>{{ post.user.name }}</strong>
                        </p>
                        

                        <!-- Отображаем контент поста -->
                        <p class="text-gray-700 mb-4">{{ post.content }}</p>

                        <div v-if="$page.props.auth.user.role === 'admin' || $page.props.auth.user.id === post.user_id">
                            <Link :href="`${post.id}/edit`"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button></Link>
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2" @click="deletePost(post.id)">Delete</button>
                        </div>
                                                
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
