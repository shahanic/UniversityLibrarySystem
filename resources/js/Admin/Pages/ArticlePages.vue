<template>
  <admin-layout>
      <template v-slot:main>
        <br>
      <h2> Article Pages</h2>
      <br>
            <table class="min-w-full border-collapse border border-gray-300 shadow-lg rounded-lg">
    <thead>
        <tr class="bg-gray-200 text-white">
            <th class="border border-gray-300 p-2 font-bold">Title</th>
            <th class="border border-gray-300 p-2 font-bold">Content</th>
            <th class="border border-gray-300 p-2 font-bold">Page</th>
            <th class="border border-gray-300 p-2 font-bold">Actions</th>
        </tr>
    </thead>  
    <tbody>
        <tr v-for="(articlex, i) in articles" :key="i" class="bg-white">
            <td class="border border-gray-300 text-gray-700 p-2">{{articlex.title}}</td>
            <td class="border border-gray-300 text-gray-700 p-2">{{articlex.content}}</td>
            <td class="border border-gray-300 text-gray-700 p-2">{{articlex.pages_id}}</td>
            <td class="border border-gray-300 text-center p-2">
                <router-link :to="{ name: 'ArticlePage', params: { id: articlex.id }}">
                  <button @click="navigate" class="bg-yellow-500 text-white px-3 py-2 rounded hover:bg-yellow-600 transition duration-300">
                    <i class="bi bi-pencil-square text-black "></i>
                  </button>
                </router-link>
            </td>
        </tr>
    </tbody>
</table>

<br>
 

      </template>
  </admin-layout>
</template>

<script setup>
import { onMounted } from 'vue';
import { articlesStore } from '@/Admin/Stores/articlepagesStores';
import { storeToRefs } from 'pinia';
import 'bootstrap-icons/font/bootstrap-icons.css';

// Access the Pinia store
const articlepage = articlesStore();
const { articles } = storeToRefs(articlepage);

// Fetch articles data when the component is mounted
onMounted(() => {
  articlepage.fetchArticlesData();
});
</script>

<style scoped>
.container {
width: 100%;
padding: 100px;
box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
border-radius: 8px;
background-color: #fff;
}

.header {
display: flex;
justify-content: space-between;
align-items: center;
margin-bottom: 10px;
}

h2 {
margin: 0;
font-size: 1.2em;
font-weight: bold;
padding-left: 7px;
text-align: center;
}

.view-details {
text-decoration: none;
color: #007BFF;
font-size: 0.9em;
}

table {
width: 100%;
border-collapse: collapse;
}

th, td {
padding: 8px;
text-align: left;
border-bottom: 1px solid #eee;
}

th {
font-weight: normal;
color: #666;
}

.avatar {
border-radius: 50%;
width: 32px;
height: 32px;
margin-right: 8px;
vertical-align: middle;
}

.leave {
color: #FF4500;
}

.negative {
color: #FF4500;
}

.positive {
color: #4CAF50;
}
</style>