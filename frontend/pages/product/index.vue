<template>
  <div>
    <topNavBar></topNavBar>
    <b-container>
      <b-row>
        <b-col>
          <b-card>
            <b-card-header>
              <h1>
                All Product
                <nuxt-link
                  class="float-right btn btn-sm btn-success"
                  :to="{ name: 'product-create' }"
                  >Add new</nuxt-link
                >
              </h1>
            </b-card-header>
            <b-card-body>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Category</th>
                    <th>Unit</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="row in products" :key="row.id">
                    <td>{{ row.id }}</td>
                    <td>{{ row.name }}</td>
                    <td>{{ row.code }}</td>
                    <td>{{ row.category }}</td>
                    <td>{{ row.unit }}</td>
                    <td>{{ row.quantity }}</td>
                    <td>
                      <b-img
                        :src="row.image"
                        rounded="circle"
                        :alt="row.name"
                        width="100"
                        height="100"
                      ></b-img>
                    </td>
                    <td>
                      <nuxt-link
                        class="btn btn-sm btn-info"
                        :to="{ name: 'product-edit', params: { product: row } }"
                        >Edit</nuxt-link
                      >
                      <nuxt-link
                        class="btn btn-sm btn-primary"
                        :to="{
                          name: 'product-update-image',
                          params: { product: row },
                        }"
                        >Change image</nuxt-link
                      >
                      <b-button
                        size="sm"
                        variant="danger"
                        class="mr-1"
                        @click="deleteProduct(row.id)"
                      >
                        Delete
                      </b-button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </b-card-body>
          </b-card>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>
<script>
export default {
  name: "product",
  data() {
    return {
      products: {},
    };
  },
  methods: {
    async fetchData() {
      try {
        let response = await this.$axios.$get("/product/index");
        this.products = response.product;
      } catch (err) {
        console.log(err);
      }
    },
    async deleteProduct(id) {
      try {
        let response = await this.$axios.$get("/product/delete/" + id);
        this.fetchData();
        this.$toast.success(response.message);
      } catch (err) {
        console.log(err);
      }
    },
  },
  mounted() {
    this.fetchData();
  },
};
</script>