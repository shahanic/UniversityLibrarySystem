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
          <div 
            v-for="button in buttons" 
            :key="button.name" 
            class="button"
            :class="`${route.path.includes(button.link.split('/')[1]) ? 'active' : ''}`"
          >
            <router-link :to="button.link">{{ button.name }}</router-link>
          </div>
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
  gap: 10px; /* Reduced gap to bring buttons closer */
}

.button {
  width: 150px;
  height: 150px;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1px solid #ccc;
  border-radius: 10px;
  background-color: #f9f9f9;
  transition: background-color 0.3s;
}

.button a {
  text-decoration: none;
  color: #333;
  font-weight: bold;
  text-align: center;
}

.button:hover {
  background-color: #e0e0e0;
}

.active {
  background-color: #007bff;
  color: #fff;
}
</style>
