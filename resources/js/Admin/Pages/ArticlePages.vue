<template>
  <admin-layout>
      <template v-slot:main>
          <!-- <h1 style="padding:20px"></h1> -->
          <div class="container mx-auto p-4">
              <h2>Article Pages</h2>
              <table>
                  <thead>
                      <tr>
                          <th>Title</th>
                          <th>Content</th>
                          <th>Page</th>
                          <th>Action</th>
                      </tr>
                      
                  </thead>  
                  <tbody>
                      <tr v-for="(articlex, i) in articles" :key="i">
                          <td>{{articlex.title}}</td>
                          <td>{{articlex.content}}</td>
                          <td>{{articlex.pages_id}}</td>
                          <td>
                            <router-link style="padding-left: 20px" :to="{name: 'ArticlePage', params: {id: articlex.id}}">Edit</router-link>
                          </td>
                      </tr>
                  </tbody>
              </table><br>
 

          </div>
      </template>
  </admin-layout>
</template>

<script setup>
import { onMounted } from 'vue';
import { articlesStore } from '@/Admin/Stores/articlepagesStores';
import { storeToRefs } from 'pinia';

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