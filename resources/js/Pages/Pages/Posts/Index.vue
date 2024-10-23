<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

// defineProps({
//   posts: {
//     type: Array,
//     default: () => [],
//   },
// });

import Pagination from '@/Components/Pagination.vue'

defineProps({
    posts: Object,
});


// const form = useForm({});

// const deletePost = (id) => {
//     form.delete(`posts/${id}`);
// };

const form = useForm({
  query: "",
});

const submit = () => {
  form.get("/posts/search");
};

const formD = useForm({
  date: "",
});

const submitD = () => {
  formD.get("/posts/searchByDate");
};



</script>

<template>
    <Head title="Manage Defects" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Defects</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        
                      <div class="flex items-center space-x-4">
                        <Link :href="route('posts.create')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                          Add Defect
                        </Link>

                        <form @submit.prevent="submit" class="flex items-center space-x-2">
                          <input 
                            type="text" 
                            class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-32" 
                            placeholder="Search..." 
                            id="query"
                            v-model="form.query" 
                          />
      
                          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Search
                          </button>
                        </form>

                        

                        <form @submit.prevent="submitD" class="flex items-center space-x-2">
                          <input 
                            type="date" 
                            class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-32" 
                            placeholder="Search By Date" 
                            id="date"
                            v-model="formD.date" 
                          />
      
                          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Search By Date
                          </button>
                        </form>
                      </div>



                        <table class="table-auto w-full mt-3">
                            <thead>
                              <tr>
                                <th class="border px-4 py-2">Date</th>
                                <th class="border px-4 py-2">User</th>
                                <th class="border px-4 py-2">Device</th>
                                <th class="border px-4 py-2">Title</th>
                              </tr>
                              </thead>
                              <tbody>
                                <tr v-for="post in posts.data" :key="post.id">
                                  <td class="border px-4 py-2">{{ new Date(post.created_at).toLocaleDateString() }}</td>
                                  <td class="border px-4 py-2">
                                    <Link :href="`/authors/${post.user.id}`" class="text-blue-500 hover:underline">
                                      {{ post.user.name }}
                                    </Link>
                                  </td>
                                  <td class="border px-4 py-2">
                                    <Link :href="`/categories/${post.category.id}`" class="text-blue-500 hover:underline">
                                      {{ post.category.title }}
                                    </Link>
                                  </td>
                                  <td class="border px-4 py-2">
                                    <Link :href="route('posts.show', post.id)" class="text-blue-500 hover:underline">
                                    {{ post.title }}
                                  </Link>
                                  </td>
                                </tr>
                            </tbody>
                        </table>

                        <Pagination class="mt-6" :links="posts.links" />
                        
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>