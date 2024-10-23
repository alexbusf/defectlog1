<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from "@inertiajs/vue3";


const props = defineProps({
    categories: Array
});


const form = useForm({
  title: "",
  content: "",
  category_id: "",
});

const submit = () => {
  form.post("/posts");
};
</script>

<template>
    <Head title="Manage Defect" />

    

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Post</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <Link href="/posts"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Back</button></Link>
                        
                        <form @submit.prevent="submit">

                            <div class="mb-4">
                                <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">Device:</label>
                                <select v-model="form.category_id" 
                                        id="category_id" 
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="" disabled>Select a device</option>
                                    <option v-for="category in categories" :key="category.id" :value="category.id">
                                        {{ category.title }}
                                    </option>
                                </select>
                            </div>
                            
                            <div class="mb-4">
                                <label 
                                    for="title" 
                                    class="block text-gray-700 text-sm font-bold mb-2">
                                    Title:</label>
                                <input 
                                    type="text" 
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                    placeholder="Enter Title" 
                                    id="title"
                                    v-model="form.title" />

                            </div>

                            <div class="mb-4">
                                <label 
                                    for="content" 
                                    class="block text-gray-700 text-sm font-bold mb-2">
                                    Description:</label>
                                <textarea 
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="content" 
                                    v-model="form.content" 
                                    placeholder="Enter Description"></textarea>
                            </div>

                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">
                                Submit
                            </button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>