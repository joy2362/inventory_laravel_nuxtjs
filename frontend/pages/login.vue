<template>
  <div>
    <b-container>
      <b-row>
        <b-col
          class="fixed-top d-flex align-items-center justify-content-center"
          style="bottom: 0; overflow-y: auto"
        >
          <b-card title="Login" style="max-width: 700px">
            <b-card-body>
              <b-form @submit.prevent="onSubmit">
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
                <a>Create new Account</a>

                <b-button type="submit" variant="primary">login</b-button>
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
  name: "login",
   auth: 'guest',
  data() {
    return {
      form: {
        email: "joy@asc.com",
        password: "987456321",
      },
    };
  },
  methods: {
    async  onSubmit() {
       try {
        let response = await this.$auth.loginWith('local', { data: this.form })
        console.log(response)
      } catch (err) {
        console.log(err)
      }
    
    },
  },
};
</script>
