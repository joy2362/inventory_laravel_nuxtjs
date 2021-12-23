<template>
  <div>
    <b-container>
      <b-row>
        <b-col
          class="fixed-top d-flex align-items-center justify-content-center"
          style="bottom: 0; overflow-y: auto"
        >
          <b-card title="Registation" style="max-width: 700px">
            <b-card-body>
              <b-form @submit.prevent="onSubmit">
                <b-form-group id="name" label="Your Name:" label-for="name">
                  <b-form-input
                    v-model="form.name"
                    id="name"
                    placeholder="Enter name"
                    required
                  ></b-form-input>
                </b-form-group>

                <b-form-group
                  id="email"
                  label="Email address:"
                  label-for="email"
                >
                  <b-form-input
                    v-model="form.email"
                    id="email"
                    type="email"
                    placeholder="Enter email"
                    required
                  ></b-form-input>
                </b-form-group>
                <b-form-group
                  id="password"
                  label="Password:"
                  label-for="password"
                >
                  <b-form-input
                    v-model="form.password"
                    id="password"
                    type="password"
                    placeholder="Enter Password"
                    required
                  ></b-form-input>
                </b-form-group>
                <nuxt-link :to="{ name: 'login' }"
                  >Have account?</nuxt-link
                >
                <b-button type="submit" variant="primary">Sign Up</b-button>
              </b-form>
            </b-card-body>
          </b-card>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>
<script>
export default {
  name: "register",
  auth: "guest",
  data() {
    return {
      form: {
        name: "",
        email: "",
        password: "",
      },
    };
  },
  methods: {
    async onSubmit() {
      try {
        let response = await this.$axios.$post("/auth/register", {
          name: this.form.name,
          email: this.form.email,
          password: this.form.password,
        });
        await this.$auth.setUserToken(response.access_token);
        console.log(response.status);
      } catch (err) {
        console.log(err);
      }
    },
  },
};
</script>
