<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <ResponsiveNavLink class="navbar-brand" :to="{ name: 'home' }">
        Home
      </ResponsiveNavLink>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'paintings.index' }">
              Paintings
            </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'donations.index' }">
              Donations
            </router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import ResponsiveNavLink from './ResponsiveNavLink.vue';

export default {
    name: "Navbar",
    components: { ResponsiveNavLink }
};
</script>
