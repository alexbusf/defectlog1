<template>
    <div class="welcome-container">
      <h1>Welcome to DefectLog</h1>
      <p>Registration is required to use the system.</p>
      <div class="buttons">
        <button v-if="canLogin" @click="login">Login</button>
        <button v-if="canRegister" @click="register">Register</button>
      </div>
      <div>{{ laravelVersion }} with PHP {{ phpVersion }}</div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      canLogin: Boolean,
      canRegister: Boolean,
      laravelVersion: String,
      phpVersion: String,
    },

    
    methods: {
      login() {
        // Логика для перехода на страницу входа
        this.$inertia.visit('/login');
      },
      register() {
        // Логика для перехода на страницу регистрации
        this.$inertia.visit('/register');
      }
    }
  }
  </script>
  
  <style scoped>
  .welcome-container {
    text-align: center;
    margin-top: 50px;
  }
  
  .buttons {
    margin-top: 20px;
  }
  
  button {
    margin: 5px;
    padding: 10px 15px;
    font-size: 16px;
    color: white; /* Text color */
    background-color: #007bff; /* Background color */
    border: none; /* Remove default border */
    border-radius: 5px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    transition: background-color 0.3s; /* Transition effect */
  }

  button:hover {
  background-color: #0056b3; /* Darker background on hover */
  }

  </style>
  