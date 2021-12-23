<template>
  <div>
    <b-navbar toggleable="lg" type="dark" variant="info">
      <b-navbar-brand href="#">Inventory</b-navbar-brand>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
          <b-nav-item href="#" v-b-toggle.sidebar-backdrop>Menu</b-nav-item>
        </b-navbar-nav>

        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
          <b-nav-item-dropdown right>
            <!-- Using 'button-content' slot -->
            <template #button-content>
              {{ user.name }}
            </template>
            <b-dropdown-item href="#" @click="logout">Logout</b-dropdown-item>
          </b-nav-item-dropdown>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
    <b-container>
      <b-sidebar
        id="sidebar-backdrop"
        title="Menu"
        backdrop-variant="transparent"
        backdrop
        shadow
      >
        <template #footer="{ hide }">
          <div class="d-flex bg-dark text-light align-items-center px-3 py-2">
            <strong class="mr-auto">Footer</strong>
            <b-button size="sm" @click="hide">Close</b-button>
          </div>
        </template>
        <div class="px-3 py-2">
          <nav class="mb-3">
            <b-nav vertical>
              <b-nav-item>Category</b-nav-item>
              <b-nav-item>Unit</b-nav-item>
              <b-nav-item>Product</b-nav-item>
              <b-nav-item>Sale</b-nav-item>
            </b-nav>
          </nav>
        </div>
      </b-sidebar>
    </b-container>
  </div>
</template>

<script>
export default {
  name: "topNavBar",
  computed: {
    user() {
      return this.$store.state.auth.user;
    },
  },
  methods: {
    async logout() {
      try {
        await this.$auth.logout();
        await redirect('login')
      } catch (err) {
        console.log(err);
      }
    },
  },
};
</script>
