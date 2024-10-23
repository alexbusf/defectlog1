<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from "@inertiajs/vue3";


// Принимаем пост через пропсы
const props = defineProps({
    post: Object
});

const form = useForm({});

const deletePost = (id) => {
    form.delete(route('posts.destroy', id));
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
                        <Link :href="route('posts.index')"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Back</button></Link>
                        
                        <h1 class="text-2xl font-bold mb-4">{{ post.title }}</h1>
                        
                        <p>
                            Date: {{ new Date(post.created_at).toLocaleDateString() }}
                        </p>
                        
                        <p>
                            Device: <Link :href="route('postsByCategory', post.category.id)" class="text-blue-500 hover:underline">
                                {{ post.category.title }}
                            </Link>
                        </p>

                        <p class="text-gray-500">
                            User: <Link :href="route('postsByUser', post.user.id)" class="text-blue-500 hover:underline">
                                {{ post.user.name }}
                            </Link>
                        </p>
                        

                        
                        <p class="text-gray-700 mb-4">{{ post.content }}</p>

                        <div v-if="$page.props.auth.user.role === 'admin' || $page.props.auth.user.id === post.user_id">
                            <Link :href="route('posts.edit', post.id)"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button></Link>
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2" @click="deletePost(post.id)">Delete</button>
                        </div>
                                                
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
