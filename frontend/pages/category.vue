<template>
  <div>
    <topNavBar></topNavBar>
    <b-container class="mt-5">
      <b-row>
        <b-col>
          <b-card>
            <b-card-header>
              <h1>
                Category
                <b-button
                  variant="success"
                  size="sm"
                  class="float-right"
                  v-b-modal.new_category
                  >Add new</b-button
                >
              </h1>
            </b-card-header>
            <b-card-body>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="row in category" :key="row.id">
                    <td>{{ row.id }}</td>
                    <td>{{ row.name }}</td>
                    <td>{{ row.description }}</td>
                    <td>
                      <b-button
                        size="sm"
                        variant="info"
                        @click="editCategory(row)"
                        class="mr-1"
                      >
                        Edit
                      </b-button>
                      <b-button
                        size="sm"
                        variant="danger"
                        @click="deleteCategory(row.id)"
                        class="mr-1"
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
    <b-modal id="new_category" hide-footer title="Add Category">
      <div class="d-block">
        <b-form @submit.prevent="addCategory">
          <b-form-group id="input-group-1" label="Name:" label-for="name">
            <b-form-input
              :state="name_validation"
              v-model="form.name"
              id="name"
              type="text"
              placeholder="Enter name"
              required
            ></b-form-input>
            <b-form-invalid-feedback :state="name_validation">
              Name must be 5-12 characters long.
            </b-form-invalid-feedback>
            <b-form-valid-feedback :state="name_validation">
              Looks Good.
            </b-form-valid-feedback>
          </b-form-group>
          <b-form-group
            id="input-group-2"
            label="Description:"
            label-for="description"
          >
            <b-form-textarea
              :state="description_validation"
              id="description"
              v-model="form.description"
              placeholder="Enter description..."
              rows="3"
              max-rows="6"
            ></b-form-textarea>
            <b-form-invalid-feedback :state="description_validation">
              Description at least 5 characters long.
            </b-form-invalid-feedback>
            <b-form-valid-feedback :state="description_validation">
              Looks Good.
            </b-form-valid-feedback>
          </b-form-group>
          <b-button type="submit" variant="primary">Save</b-button>
        </b-form>
      </div>
    </b-modal>
    <b-modal id="edit_category" hide-footer title="Edit Category">
      <div class="d-block">
        <b-form @submit.prevent="UpdateCategory">
          <b-form-group id="input-group-1" label="Name:" label-for="name">
            <b-form-input
              :state="edit_name_validation"
              v-model="editform.name"
              id="name"
              type="text"
              placeholder="Enter name"
              required
            ></b-form-input>
            <b-form-invalid-feedback :state="edit_name_validation">
              Name must be 5-12 characters long.
            </b-form-invalid-feedback>
            <b-form-valid-feedback :state="edit_name_validation">
              Looks Good.
            </b-form-valid-feedback>
          </b-form-group>
          <b-form-group
            id="input-group-2"
            label="Description:"
            label-for="description"
          >
            <b-form-textarea
              :state="edit_description_validation"
              id="description"
              v-model="editform.description"
              placeholder="Enter description..."
              rows="3"
              max-rows="6"
            ></b-form-textarea>
            <b-form-invalid-feedback :state="edit_description_validation">
              Description at least 5 characters long.
            </b-form-invalid-feedback>
            <b-form-valid-feedback :state="edit_description_validation">
              Looks Good.
            </b-form-valid-feedback>
          </b-form-group>
          <b-button type="submit" variant="primary">Save Change</b-button>
        </b-form>
      </div>
    </b-modal>
  </div>
</template>

<script>
export default {
  name: "category",
  head() {
    return {
      title: "Category",
    };
  },
  data() {
    return {
      form: {
        name: "",
        description: "",
       
      },
      editform: {
        name: "",
        description: "",
         id: "",
      },
      category: {},
    };
  },
  computed: {
    name_validation() {
      return this.form.name.length > 4 && this.form.name.length < 13;
    },
    edit_name_validation() {
      return this.editform.name.length > 4 && this.form.name.length < 13;
    },
    description_validation() {
      return this.form.description.length > 4;
    },
    edit_description_validation() {
      return this.editform.description.length > 4;
    },
  },

  methods: {
    async addCategory() {
      try {
        let response = await this.$axios.$post("/category/store", {
          name: this.form.name,
          description: this.form.description,
        });
        this.fethCategory();
        this.$bvModal.hide("new_category");
        this.form.name = "";
        this.form.description = "";
      } catch (err) {
        console.log(err);
      }
    },

    async UpdateCategory() {
      try {
        let response = await this.$axios.$post(
          "/category/update/" + this.editform.id,
          {
            name: this.editform.name,
            description: this.editform.description,
          }
        );
        this.fethCategory();
        this.$bvModal.hide("edit_category");

        this.editform.name = "";
        this.editform.id = "";
        this.editform.description = "";
      } catch (err) {
        console.log(err);
      }
    },

    async fethCategory() {
      try {
        let response = await this.$axios.$get("/category/index");
        this.category = response.category;
      } catch (err) {
        console.log(err);
      }
    },

    async deleteCategory(id) {
      try {
        let response = await this.$axios.$get("/category/delete/" + id);
        this.fethCategory();
      } catch (err) {
        console.log(err);
      }
    },
    
    editCategory(item) {
      this.editform.name = item.name;
      this.editform.id = item.id;
      this.editform.description = item.description;
      this.$bvModal.show("edit_category");
    },
  },
  mounted() {
    this.fethCategory();
  },
};
</script>
