<template>
    <!-- Login Form -->
    <div class="auth-form">
        <!-- Title -->
        <h4 class="text-center mb-4">LogIn</h4>

        <!-- Name Input -->
        <div class="form-group">
            <b-form-input variant="dark" placeholder="Username" v-model="name"></b-form-input>

            <!-- Errors Name Output -->
            <span class="text-danger" v-if="errors.has('name')">{{errors.get('name')}}</span>
        </div>

        <!-- Password Input -->
        <div class="form-group mb-4">
            <b-form-input type="password" placeholder="Password"
                          v-model="password"></b-form-input>

            <!-- Errors Password Output -->
            <span class="text-danger" v-if="errors.has('password')">{{errors.get('password')}}</span>
        </div>

        <!-- Button -->
        <div class="form-group">
            <b-btn @click="onSubmit" block variant="">Log In</b-btn>
        </div>
    </div>
    <!-- End Login Form -->
</template>

<script>
  import {Errors} from "../../bootstrap";

  export default {
    data() {
      return {
        name: '',
        password: '',
        errors: new Errors()
      }
    },
    methods: {
      onSubmit() {
        axios.post('/login', {
          name: this.name,
          password: this.password
        })
            .then(response => {
              window.location.replace("/");
            })
            .catch(errors => {
              this.errors.record(errors.response.data.errors);
            });
      },
      lol() {
        alert();
      }
    }
  }
</script>

<style scoped>
    .auth-form {
        position: absolute;
        top: 50%;
        left: 50%;
        min-width: 400px;
        transform: translate(-50%, -50%);
    }
</style>