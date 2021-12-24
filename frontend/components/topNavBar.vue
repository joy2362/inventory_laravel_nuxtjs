<template>
  <div>
    <b-navbar toggleable="lg" type="dark" variant="info">
      <b-navbar-brand
        >Inventory
        <b-link href="#" v-b-toggle.sidebar-backdrop class="sideMenueBtn">
          <b-icon
            animation="cylon"
            icon="list-nested"
            aria-hidden="true"
          ></b-icon></b-link
      ></b-navbar-brand>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
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
        title="Inventory"
        backdrop-variant="transparent"
        backdrop
        shadow
        bg-variant="dark"
        text-variant="white"
        width="200px"
      >
        <div class="px-3 py-2">
          <nav class="mb-3">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 sideNavBarUl">
              <li class="nav-item">
                <nuxt-link :to="{ name: 'index' }" class="nav-link">
                  <b-icon
                    animation="cylon"
                    icon="emoji-sunglasses-fill"
                    aria-hidden="true"
                  ></b-icon>
                  Home</nuxt-link
                >
              </li>
              <li class="nav-item">
                <nuxt-link :to="{ name: 'category' }" class="nav-link">
                  <b-icon
                    animation="cylon"
                    icon="emoji-smile-fill"
                    aria-hidden="true"
                  ></b-icon>
                  Category</nuxt-link
                >
              </li>
              <li class="nav-item">
                <nuxt-link :to="{ name: 'unit' }" class="nav-link">
                  <b-icon
                    animation="cylon"
                    icon="emoji-heart-eyes-fill"
                    aria-hidden="true"
                  ></b-icon>
                  Unit</nuxt-link
                >
              </li>
              <li class="nav-item">
                <nuxt-link :to="{ name: 'product' }" class="nav-link">
                  <b-icon
                    animation="cylon"
                    icon="emoji-laughing-fill"
                    aria-hidden="true"
                  ></b-icon>
                  Product</nuxt-link
                >
              </li>
               <li class="nav-item">
                <nuxt-link :to="{ name: 'sale' }" class="nav-link">
                  <b-icon
                    animation="cylon"
                    icon="emoji-laughing-fill"
                    aria-hidden="true"
                  ></b-icon>
                  Sale</nuxt-link
                >
              </li>
            </ul>
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
        await this.$auth.logout().then(() => this.$toast.error("Logged Out!"));
        await redirect("login");
      } catch (err) {
        console.log(err);
      }
    },
  },
};
</script>
<style scoped>
.sideMenueBtn {
  color: rgb(2, 2, 2);
  font-family: helvetica;
  text-decoration: none;
  font-size: 25px;
}
.sideMenueBtn:hover {
  color: rgb(255, 255, 255);
}
.sideNavBarUl {
  padding: 0;
  width: 100%;
}
.sideNavBarUl li .nav-link{
  outline: none;
  text-decoration: none;
  text-align: center;
  line-height: 3;
  color: rgb(184, 184, 184);

}
.sideNavBarUl li .nav-link:hover {
  
  background: rgb(87, 87, 87);
}
</style>