<template>
    <div class="text-center mt-12">
      <h1 class="text-4xl font-bold mb-8">Welcome to DefectLog application!</h1>
  
      <div class="flex justify-center mb-4">
        <div v-if="canLogin" class="mr-4">
          <Link :href="route('login')"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Login</button></Link>
        </div>
    
        <div v-if="canRegister">
          <Link :href="route('register')"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Register</button></Link>
        </div>
      </div>
      
      <p class="text-gray-600">Laravel version: {{ laravelVersion }}</p>
      <p class="text-gray-600">PHP version: {{ phpVersion }}</p>
    </div>
  </template>
  
  <script>
  import { Link } from '@inertiajs/vue3'
  
  export default {
    props: {
      canLogin: {
        type: Boolean,
        required: true
      },
      canRegister: {
        type: Boolean,
        required: true
      },
      laravelVersion: {
        type: String,
        required: true
      },
      phpVersion: {
        type: String,
        required: true
      }
    },
    components: {
      Link
    }
  }
  </script>
  
  <style scoped>
  /* Если у вас настроен Tailwind, отдельные стили не нужны */
  </style>