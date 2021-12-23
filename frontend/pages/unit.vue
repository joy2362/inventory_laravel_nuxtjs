<template>
  <div>
    <topNavBar></topNavBar>
    <b-container class="mt-5">
      <b-row>
        <b-col>
          <b-card>
            <b-card-header>
              <h1>
                Unit
                <b-button
                  variant="success"
                  size="sm"
                  class="float-right"
                  v-b-modal.new_unit
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
                    <th>Code</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="row in unit" :key="row.id">
                    <td>{{ row.id }}</td>
                    <td>{{ row.name }}</td>
                    <td>{{ row.code }}</td>
                    <td>
                      <b-button
                        size="sm"
                        variant="info"
                        @click="EditUnit(row)"
                        class="mr-1"
                      >
                        Edit
                      </b-button>
                      <b-button
                        size="sm"
                        variant="danger"
                        @click="deleteUnit(row.id)"
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
    <b-modal id="new_unit" hide-footer title="Add Unit">
      <div class="d-block">
        <b-form @submit.prevent="add_unit()">
          <b-form-group id="input-group-1" label="Name:" label-for="name">
            <b-form-input
              :state="name_validation"
              v-model="form.name"
              id="name"
              type="text"
              placeholder="Enter Name"
              required
            ></b-form-input>
            <b-form-invalid-feedback :state="name_validation">
              Name must be 5-12 characters long.
            </b-form-invalid-feedback>
            <b-form-valid-feedback :state="name_validation">
              Looks Good.
            </b-form-valid-feedback>
          </b-form-group>
          <b-form-group id="input-group-2" label="Your Code:" label-for="Code">
            <b-form-input
              :state="code_validation"
              v-model="form.code"
              id="Code"
              placeholder="Enter Code"
              required
            ></b-form-input>
            <b-form-invalid-feedback :state="code_validation">
              Code must be 5-12 characters long.
            </b-form-invalid-feedback>
            <b-form-valid-feedback :state="code_validation">
              Looks Good.
            </b-form-valid-feedback>
          </b-form-group>
          <b-button type="submit" variant="primary">Save</b-button>
        </b-form>
      </div>
    </b-modal>

    <b-modal id="edit_unit" hide-footer title="Edit Unit">
      <div class="d-block">
        <b-form @submit.prevent="UpdateUnit()">
          <b-form-group id="input-group-1" label="Name:" label-for="name">
            <b-form-input
              :state="edit_name_validation"
              v-model="editform.name"
              id="name"
              type="text"
              placeholder="Enter Name"
              required
            ></b-form-input>
            <b-form-invalid-feedback :state="edit_name_validation">
              Name must be 5-12 characters long.
            </b-form-invalid-feedback>
            <b-form-valid-feedback :state="edit_name_validation">
              Looks Good.
            </b-form-valid-feedback>
          </b-form-group>
          <b-form-group id="input-group-2" label="Your Code:" label-for="Code">
            <b-form-input
              :state="edit_code_validation"
              v-model="editform.code"
              id="Code"
              placeholder="Enter Code"
              required
            ></b-form-input>
            <b-form-invalid-feedback :state="edit_code_validation">
              Code must be 5-12 characters long.
            </b-form-invalid-feedback>
            <b-form-valid-feedback :state="edit_code_validation">
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
  name: "unit",
  head() {
    return {
      title: "Unit",
    };
  },
  data() {
    return {
      form: {
        name: "",
        code: "",
      },
      editform: {
        name: "",
        code: "",
        id: "",
      },
      unit: {},
    };
  },
  methods: {
    async add_unit() {
      try {
        let response = await this.$axios.$post("/unit/store", {
          name: this.form.name,
          code: this.form.code,
        });
        this.fethunit();
        this.$bvModal.hide("new_unit");
        this.form.name = "";
        this.form.code = "";
      } catch (err) {
        console.log(err);
      }
    },
    async fethunit() {
      try {
        let response = await this.$axios.$get("/unit/index");
        this.unit = response.unit;
      } catch (err) {
        console.log(err);
      }
    },
    async deleteUnit(id) {
      try {
        let response = await this.$axios.$get("/unit/delete/" + id);
        this.fethunit();
      } catch (err) {
        console.log(err);
      }
    },
     async UpdateUnit() {
      try {
        let response = await this.$axios.$post(
          "/unit/update/" + this.editform.id,
          {
            name: this.editform.name,
            code: this.editform.code,
          }
        );
        this.fethunit();
        this.$bvModal.hide("edit_unit");

        this.editform.name = "";
        this.editform.id = "";
        this.editform.code = "";
      } catch (err) {
        console.log(err);
      }
    },
    EditUnit(item) {
      this.editform.name = item.name;
      this.editform.id = item.id;
      this.editform.code = item.code;
      this.$bvModal.show("edit_unit");
    },
  },
  computed: {
    name_validation() {
      return this.form.name.length > 4;
    },
    code_validation() {
      return this.form.code.length > 4;
    },
    edit_name_validation() {
      return this.editform.name.length > 4;
    },
    edit_code_validation() {
      return this.editform.code.length > 4;
    },
  },
  mounted() {
    this.fethunit();
  },
};
</script>
