<template>
  <form @submit.prevent="login" class="grid grid-cols-1 gap-4 justify-items-center">
    <h2 class="text-center">Login</h2>
    <label for="email">Email:</label>
    <input type="email" id="email" v-model="form.email" required />

    <label for="password" class="text-center">Password:</label>
    <input type="password" id="password" v-model="form.password" required />

    <button type="submit" class="bg-purple text-white px-4 py-2 rounded">Login</button>

    <div v-if="loginError" class="text-red-500 text-center">{{ loginError }}</div>
  </form>
</template>


<script>
export default {
  data() {
    return {
      form: {
        email: "",
        password: "",
      },
      loginError: "",
    };
  },
  methods: {
    async login() {
  try {
    const response = await fetch("http://localhost:8001/api/login", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(this.form),
    });

    console.log("Response status:", response.status); // Add this line

    if (response.ok) {
      const data = await response.json();
      localStorage.setItem("token", data.token);
      console.log("Token stored:", data.token);
    } else {
      console.log("Response not OK:", response.statusText); // Add this line
      throw new Error("Error logging in");
    }
  } catch (error) {
    console.error("Error caught:", error); // Add this line
    this.loginError = "Failed to login: " + error.message;
  }
}
,
  },
};
</script>
