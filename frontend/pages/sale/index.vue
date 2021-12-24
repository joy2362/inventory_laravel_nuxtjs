<template>
  <div>
    <TopNavBar></TopNavBar>
    <b-container class="mt-4">
      <b-row>
        <b-col>
          <b-card>
            <b-card-header>
              <h2>
                Sale
                <div class="float-right">
                  <b-input-group>
                    <b-form-input
                      id="filter-input"
                      v-model="filter"
                      type="search"
                      placeholder="Type to Search"
                    ></b-form-input>
                  </b-input-group>
                </div>
              </h2>
            </b-card-header>

            <b-card-body>
              <b-table
                :items="items"
                :fields="fields"
                :filter="filter"
                stacked="md"
                show-empty
                small
              >
                <template #cell(image)="row">
                  <b-img
                    :src="row.value"
                    rounded
                    :alt="row.value"
                    width="50"
                    height="50"
                  ></b-img>
                </template>
                <template #cell(id)="row">
                  <b-form-input
                    id="quentity"
                    placeholder="Quentity"
                    required
                    type="number"
                    min="1"

                    v-model="selected[row.value]"
                  ></b-form-input>
                  
                </template>
              </b-table>
            </b-card-body>
            <b-card-footer>
              <nuxt-link :to="{name: 'sale-cutomer-details' , params: { selected: selected }}">Proceed </nuxt-link>
                <b-btn class="float-right" v-if="selected" v-b-modal.customer_details>
                  Proceed
                </b-btn>
            </b-card-footer>
          </b-card>
        </b-col>
      </b-row>
    </b-container>
    <pre>{{selected}}</pre>
  </div>
</template>

<script>
export default {
  data() {
    return {
      selected:{},
      items: [],
      fields: [
        { key: "name", sortable: true, label: "Product" },
        { key: "code", sortable: true, label: "Product Code" },
        { key: "category", sortable: true },
        { key: "quantity", sortable: true, label: "Stock" },
        { key: "image", sortable: false },
        { key: "id", sortable: false, label: "Quantity" },
      ],
      filter: null,
    };
  },

  mounted() {
    this.fetchData();
  },
  methods: {
    async fetchData() {
      try {
        let response = await this.$axios.$get("/product/index");
        this.items = response.product;
      } catch (err) {
        console.log(err);
      }
    },
  },
};
</script>