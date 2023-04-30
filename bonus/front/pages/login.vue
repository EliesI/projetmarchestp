<template>
    <div class="w-1/2 mx-auto mb-10">
      <register-form v-if="showRegister" />
      <login-form v-else />
      <button @click="toggleForms" class="mt-10">Switch to {{ showRegister ? 'Login' : 'Register' }}</button>
    </div>
  </template>
  
  <script>
  import RegisterForm from '@/components/RegisterForm.vue';
  import LoginForm from '@/components/LoginForm.vue';
  
  export default {
    components: {
      RegisterForm,
      LoginForm,
    },
    data() {
      return {
        showRegister: true,
      };
    },
    methods: {
      toggleForms() {
        this.showRegister = !this.showRegister;
      },
    },
  };
  </script>
  