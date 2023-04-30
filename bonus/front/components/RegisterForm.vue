<template>
  <div>
    <form @submit.prevent="registerUser" class="grid grid-cols-1 gap-4 justify-items-center">
      <h2>Register</h2>
      <label for="email">Email:</label>
      <input type="email" id="email" v-model="form.email" required />

      <label for="password">Password:</label>
      <input type="password" id="password" v-model="form.password" required />

      <label for="confirm_password">Confirm Password:</label>
      <input type="password" id="confirm_password" v-model="form.confirm_password" required />

      <label for="login">Login:</label>
      <input type="text" id="login" v-model="form.login" required />

      <label for="firstname">First Name:</label>
      <input type="text" id="firstname" v-model="form.firstname" required />

      <label for="lastname">Last Name:</label>
      <input type="text" id="lastname" v-model="form.lastname" required />

      <button type="submit" class="bg-purple text-white px-4 py-2 rounded">Register</button>
    </form>
    <div v-if="registerSuccess">{{ registerSuccess }}</div>
    <div v-if="registerError">{{ registerError }}</div>
  </div>
</template>
  
<script>
export default {
  data() {
    return {
      form: {
        email: "",
        password: "",
        confirm_password: "",
        login: "",
        firstname: "",
        lastname: "",
      },
      registerSuccess: "",
      registerError: "",
    };
  },
  methods: {
    registerUser() {
      if (this.form.password.first !== this.form.password.second) {
        this.registerError = "The password fields must match.";
        return;
      }

      const data = {
        email: this.form.email,
        password: {
          first: this.form.password,
          second: this.form.confirm_password
        },
        login: this.form.login,
        firstname: this.form.firstname,
        lastname: this.form.lastname
      };

      fetch("http://localhost:8001/api/register", {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
      })
        .then((response) => {
          if (response.ok) {
            this.registerSuccess = "User registered successfully!";
            this.registerError = "";
          } else {
            this.registerSuccess = "";
            this.registerError = "Failed to register user.";
          }
        })
        .catch((error) => {
          this.registerSuccess = "";
          this.registerError = "Failed to register user: " + error.message;
        });
    },
  },
};
</script>
  