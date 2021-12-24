<template>
  <div>
    <TopNavBar></TopNavBar>
    <b-container class="mt-4">
      <b-row>
        <b-col>
          <b-card>
            <b-card-header>
              <h4>Customer Details</h4>
            </b-card-header>
            <b-card-body>
              <b-form @submit.prevent="sale">
                <b-form-group id="input-group-1" label="Name:" label-for="name">
                  <b-form-input
                    v-model="form.name"
                    id="number"
                    type="text"
                    placeholder="Enter name"
                    required
                  ></b-form-input>
                </b-form-group>

                <b-form-group
                  id="input-group-1"
                  label="Mobile Number:"
                  label-for="number"
                >
                  <b-form-input
                    v-model="form.number"
                    id="number"
                    type="text"
                    placeholder="Enter mobile number"
                    required
                  ></b-form-input>
                </b-form-group>
                <b-button type="submit" variant="primary">Sale</b-button>
              </b-form>
            </b-card-body>
          </b-card>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>
<script >
export default {
  name: "customer-details",
  data() {
    return {
      selected: {},
      form: {
        name: "",
        number: "",
      },
    };
  },
  methods: {
    async sale() {
      const formData = new FormData();
      formData.append("name", this.form.name);
      formData.append("mobile_number", this.form.number);
      formData.append("products", this.selected);
      try {
        let response = await this.$axios.$post("/sale/store", {
            products: this.selected,
            name:this.form.name,
            mobile_number:this.form.number
        });
        //console.log(response);
        this.$toast.success(response.message);
        this.$router.back();
      } catch (err) {
        console.log(err);
      }
    },
  },
  mounted() {
    if (!this.$route.params.selected) {
      this.$router.back();
    }
    this.selected = this.$route.params.selected;
  },
};
</script>