<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
  categories: {
    type: Array,
    default: () => [],
  },
});

const form = useForm({});

const deleteCategory = (id) => {
    form.delete(`categories/${id}`);
};
</script>

<template>
    <Head title="Manage devices" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage devices</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div v-if="$page.props.auth.user.role === 'admin'">
                          <Link href="categories/create"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Add device</button></Link>
                        </div>
                        <table class="table-auto w-full">
                            <thead>
                              <tr>
                                <th class="border px-4 py-2">ID</th>
                                <th class="border px-4 py-2">Title</th>
                                <th class="border px-4 py-2" width="250px">Action</th>
                              </tr>
                              </thead>
                              <tbody>
                                <tr v-for="category in categories" :key="category.id">
                                  <td class="border px-4 py-2">{{ category.id }}</td>
                                  <td class="border px-4 py-2">{{ category.title }}</td>
                                  <td class="border px-4 py-2">
                                    <div v-if="$page.props.auth.user.role === 'admin'">
                                      <Link :href="`categories/${category.id}/edit`"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button></Link>
                                      <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2" @click="deleteCategory(category.id)">Delete</button>
                                    </div>
                                  </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>