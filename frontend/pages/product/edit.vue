<template>
  <div>
    <TopNavBar></TopNavBar>
    <b-container>
      <b-row>
        <b-col>
          <b-card>
            <b-card-header>
              <h1>
                Edit Prodct<nuxt-link
                  class="float-right btn btn-sm btn-success"
                  :to="{ name: 'product' }"
                  >ALL Product</nuxt-link
                >
              </h1>
            </b-card-header>
            <b-card-body>
              <b-form @submit.prevent="updateProduct()">
                <b-row>
                  <b-col>
                    <b-form-group
                      id="input-group-1"
                      label="Product Name:"
                      label-for="name"
                    >
                      <b-form-input
                        id="name"
                        type="text"
                        placeholder="Enter Product Name"
                        required
                        v-model="product.name"
                      ></b-form-input>
                    </b-form-group>
                  </b-col>
                  <b-col>
                    <b-form-group
                      id="input-group-2"
                      label="Product Code:"
                      label-for="code"
                    >
                      <b-form-input
                        id="code"
                        type="text"
                        placeholder="Enter Product Code"
                        required
                        v-model="product.code"
                      ></b-form-input>
                    </b-form-group>
                  </b-col>
                </b-row>

                <b-row>
                  <b-col>
                    <b-form-group
                      id="input-group-3"
                      label="Brand Name:"
                      label-for="brand"
                    >
                      <b-form-input
                        id="brand"
                        type="text"
                        placeholder="Enter Brand Name"
                        required
                        v-model="product.brand"
                      ></b-form-input>
                    </b-form-group>
                  </b-col>
                  <b-col>
                    <b-form-group
                      id="input-group-4"
                      label="Product quentity:"
                      label-for="quentity"
                    >
                      <b-form-input
                        id="quentity"
                        placeholder="Enter Product quentity"
                        required
                        type="number"
                        min="1"
                        v-model="product.quantity"
                      ></b-form-input>
                    </b-form-group>
                  </b-col>
                   <b-col>
                    <b-form-group
                      id="input-group-4"
                      label="Product price:"
                      label-for="price"
                    >
                      <b-form-input
                        id="price"
                        placeholder="Enter Product price"
                        required
                        type="number"
                        min="1"
                        v-model="product.price"
                      ></b-form-input>
                    </b-form-group>
                  </b-col>
                </b-row>

                <b-row>
                  <b-col>
                    <b-form-group
                      id="input-group-5"
                      label="Category:"
                      label-for="category"
                    >
                      <b-form-select
                        id="category"
                        :options="category"
                        value-field="id"
                        text-field="name"
                        required
                        v-model="product.category_id"
                      >
                      </b-form-select>
                    </b-form-group>
                  </b-col>
                  <b-col>
                    <b-form-group
                      id="input-group-6"
                      label="Unit:"
                      label-for="unit"
                    >
                      <b-form-select
                        id="unit"
                        :options="unit"
                        value-field="id"
                        text-field="name"
                        required
                        v-model="product.unit_id"
                      >
                      </b-form-select>
                    </b-form-group>
                  </b-col>
                </b-row>

                <b-form-group
                  id="input-group-7"
                  label="Description:"
                  label-for="description"
                >
                  <b-form-textarea
                    id="description"
                    v-model="product.description"
                    placeholder="Enter something..."
                    rows="3"
                    max-rows="6"
                    required
                  ></b-form-textarea>
                </b-form-group>
                <b-button type="submit" variant="primary">Save change</b-button>
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
  name: "product-edit",
  data() {
    return {
      category: [],
      unit: [],
      product: {
        name: "",
        code: "",
        category_id: "",
        unit_id: "",
        brand: "",
        quantity: "",
        description: "",
        id: "",
        price:""
      },
    };
  },

  methods: {
    fetchProduct() {
      if (!this.$route.params.product) {
        this.$router.back();
      }
      this.product.id = this.$route.params.product.id;
      this.product.name = this.$route.params.product.name;
      this.product.unit_id = this.$route.params.product.unit_id;
      this.product.category_id = this.$route.params.product.category_id;
      this.product.code = this.$route.params.product.code;
      this.product.brand = this.$route.params.product.brand;
      this.product.quantity = this.$route.params.product.quantity;
      this.product.description = this.$route.params.product.description;
      this.product.price = this.$route.params.product.price;
    },
    async getCategory() {
      try {
        let response = await this.$axios.$get("/category/index");
        this.category = response.category;
      } catch (err) {
        console.log(err);
      }
    },
    async updateProduct() {
      const formData = new FormData();
      formData.append("name", this.product.name);
      formData.append("code", this.product.code);
      formData.append("category", this.product.category_id);
      formData.append("unit", this.product.unit_id);
      formData.append("brand", this.product.brand);
      formData.append("quantity", this.product.quantity);
      formData.append("description", this.product.description);
      formData.append("price", this.product.price);

      try {
        let response = await this.$axios.$post(
          "/product/update/" + this.product.id,
          formData
        );

        this.$toast.success(response.message);
        this.$router.back();
      } catch (err) {
        console.log(err);
      }
    },

    async getUnit() {
      try {
        let response = await this.$axios.$get("/unit/index");
        this.unit = response.unit;
      } catch (err) {
        console.log(err);
      }
    },
  },
  mounted() {
    this.fetchProduct();
    this.getCategory();
    this.getUnit();
  },
};
</script>