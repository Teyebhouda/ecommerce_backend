<template>
  <section class="banner-section position-relative z-1 overflow-hidden bg-white">
    <img
      src="/assets/img/shapes/bg-shape-3.png"
      alt="bg shape"
      class="position-absolute start-0 bottom-0 z--1 w-100"
    />

    <div class="container">
      <div class="row align-items-center g-4">
        <div
          v-for="(banner, index) in banners"
          :key="index"
          class="col-xl-4 col-md-6"
        >
          <a :href="banner.link" class="d-block">
            <img
              :src="banner.image_full_path"
              alt="banner"
              class="img-fluid"
            />
          </a>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import axios from "axios";

export default {
  name: "HomeBanner",

  data() {
    return {
      banners: [],
    };
  },

  async mounted() {
    try {
      const response = await axios.get("/api/banner/home");

      // Si votre BannerResource retourne { image, link }
      this.banners = response.data.data;
    } catch (error) {
      console.error("Erreur lors du chargement des bannières :", error);
    }
  },
};
</script>

<style scoped>
/* Ajoutez du style si nécessaire */
</style>
