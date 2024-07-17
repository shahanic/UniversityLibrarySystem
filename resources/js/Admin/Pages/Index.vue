<script setup>
import { ref } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();

const buttons = [
  { name: 'Generic Page', link: '/generic-pages' },
  { name: 'Articles', link: '/article-pages' },
  { name: 'FAQs', link: '/faqs' },
  { name: 'Quick Links', link: '/quick-links' },
  { name: 'Images', link: '/images' },
  { name: 'Accounts', link: '/accounts' }
];
</script>

<template>
  <admin-layout>
    <template v-slot:main>
      <div class="home-page">
        <h1>Home Page</h1>
        <div class="buttons-container">
          <router-link 
            v-for="button in buttons" 
            :key="button.name" 
            :to="button.link" 
            class="button"
            :class="`${route.path.includes(button.link.split('/')[1]) ? 'active' : ''}`"
          >
            {{ button.name }}
          </router-link>
        </div>
      </div>
    </template>
  </admin-layout>
</template>

<style scoped>
.home-page {
  text-align: center;
  margin: 20px;
}

.buttons-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 50px; /* Reduced gap to bring buttons closer */
}

.button {
  width: 150px;
  height: 150px;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1px solid #ccc;
  border-radius: 10px;
  background-color: #353F46B3; /* Change to your preferred shade of gray */
  transition: background-color 0.3s;
  text-decoration: none;
  color: #f5f5f5;
  font-weight: bold;
  text-align: center;
  margin-top: 50px;

}


.button:hover {
  background-color: #e0e0e0;
}

.active {
  background-color: #007bff;
  color: #fff;
}
</style>
