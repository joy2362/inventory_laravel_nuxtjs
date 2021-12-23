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
              <b-table striped hover :items="items"></b-table>
            </b-card-body>
          </b-card>
        </b-col>
      </b-row>
    </b-container>
    <b-modal id="new_unit" hide-footer title="Add Unit">
      <div class="d-block">
        <b-form >
          <b-form-group id="input-group-1" label="Name:" label-for="name">
            <b-form-input
            v-model="form.name"
              id="name"
              type="text"
              placeholder="Enter Name"
              required
            ></b-form-input>
          </b-form-group>
          <b-form-group
            id="input-group-2"
            label="Your Code:"
            label-for="Code"
          >
            <b-form-input
            v-model="form.code"
              id="Code"
              placeholder="Enter Code"
              required
            ></b-form-input>
           
          </b-form-group>
          <b-button type="submit" variant="primary">Submit</b-button>
        </b-form>

      </div>
    </b-modal>
  </div>
</template>

<script>
export default {
  name: "unit",
  data() {
    return {
      form: {
        name: "",
        code: "",
      },
      items: [
        { id: 40, name: "Dickerson", description: "Macdonald" },
        { id: 40, name: "Dickerson", description: "Macdonald" },
        { id: 40, name: "Dickerson", description: "Macdonald" },
        { id: 40, name: "Dickerson", description: "Macdonald" },
      ],
    };
  },


};
</script>
