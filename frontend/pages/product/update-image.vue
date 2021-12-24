<template>
  <div>
    <TopNavBar></TopNavBar>
    <b-container>
      <b-row>
        <b-col>
          <b-card>
            <b-card-header>
              <h1>
                Update Image
                <nuxt-link
                  class="float-right btn btn-sm btn-success"
                  :to="{ name: 'product' }"
                  >ALL Product</nuxt-link
                >
              </h1>
            </b-card-header>
            <b-card-body>
              <b-row>
                <b-col class="text-center">
                  <b-img
                    :src="product.image"
                    rounded
                    :alt="product.name"
                    width="200"
                    height="200"
                  ></b-img>
                </b-col>
              </b-row>
              <b-row class="mt-5">
                <b-col class="text-center">
                  <b-form @submit.prevent="updateImage()">
                    <b-form-group
                      id="input-group-7"
                      label="Image:"
                      label-for="image"
                    >
                      <b-form-file
                        v-model="form.image"
                        placeholder="Choose a file or drop it here..."
                        drop-placeholder="Drop file here..."
                        required
                        accept="image/*"
                        id="image"
                      ></b-form-file>
                    </b-form-group>
                    <b-button type="submit" variant="primary">Change</b-button>
                  </b-form>
                </b-col>
              </b-row>
            </b-card-body>
          </b-card>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
export default {
  name: "product-update-image",
  data() {
    return {
      product: {
        name: "",
        image: null,
        id: "",
      },
      form: {
        image: null,
      },
    };
  },
  methods: {
    fetchProduct() {
      if (!this.$route.params.product) {
        this.$router.back();
      } else {
        this.product.id = this.$route.params.product.id;
        this.product.name = this.$route.params.product.name;
        this.product.image = this.$route.params.product.image;
      }
    },
   async updateImage() {
      const formData = new FormData();
      formData.append("image", this.form.image, this.form.image.name);

      try {
        let response = await this.$axios.$post(
          "/product/update-image/" + this.product.id,
          formData
        );

        this.$toast.success(response.message);
        this.$router.back();
      } catch (err) {
        console.log(err);
      }
    },
  },
  mounted() {
    this.fetchProduct();
  },
};
</script>