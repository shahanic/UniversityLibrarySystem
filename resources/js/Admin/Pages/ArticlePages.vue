<template>
  <admin-layout>
    <template v-slot:main>
      <PreviewArticle v-if="preview" :data="newArticle"></PreviewArticle>
      <AddArticle v-if="adding" :data="newArticle"></AddArticle>
      <EditArticle v-if="editing" :data="currentArticle"></EditArticle>
      <div v-if="!adding && !editing && !preview" style="width: 90%; margin: 0 auto; margin-top: 2%;">
        <h2 style="text-align: center; margin-bottom: 10px;">Article Pages</h2>
        <button @click="articlepage.addArticle(articlepage.newArticle)" class="button button-add">Add New Article</button>
        <br><br>
        <table class="styled-table">
          <thead>
            <tr>
              <th>Title</th>
              <th>Description</th>
              <th>Status</th>
              <th class="actions-header">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(articlex, i) in articles" :key="i">
              <td>{{ articlex.title }}</td>
              <td>{{ articlex.abstract }}</td>
              <td>{{ articlex.status === 1 ? 'Published' : 'Drafted' }}</td>
              <td class="actions">
                <button @click="articlepage.previewContent(articlex.id)" class="button button-preview">
                    <i class="bi bi-eye" style="margin-right: 8px;"></i>Preview
                  </button>
                <button @click="articlepage.editArticle(articlex)" class="button button-add">Edit moko idolo labyu
                  <i class="bi bi-pencil-square"></i>
                </button>
                <button @click="articlepage.deleteArticle(articlex.id)" class="button button-delete">
                    <i class="bi bi-trash"></i>
                  </button>
              </td>
              
            </tr>
          </tbody>
        </table>
        <br>
        
      </div>
    </template>
  </admin-layout>
</template>
<script setup>
import PreviewArticle from '@/Admin/Modals/PreviewArticle.vue'
import AddArticle from '@/Admin/Modals/AddArticle.vue'
import EditArticle from '../Modals/EditArticle.vue';
import { onMounted, watch, watchEffect } from 'vue';
import { articlesStore } from '@/Admin/Stores/articlepagesStores';
import { storeToRefs } from 'pinia';
import 'bootstrap-icons/font/bootstrap-icons.css';

const articlepage = articlesStore();
const { articles, newArticle, currentArticle, adding, editing, preview } = storeToRefs(articlepage);

watchEffect(() => {
  articlepage.fetchArticlesData();

});

const handleReload = (newVal, oldVal) => {
      if (oldVal === true && newVal === false) {
        articlepage.fetchArticlesData();
      }
};
// watch(editing, handleReload);
watch(adding, handleReload);
watch(editing, handleReload);


</script>

<style scoped>
.styled-table {
  width: 100%;
  border-collapse: collapse;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  margin: 0 auto;
}

.styled-table thead {
  background-color: #d3d3d3;
  color: black;
}

.styled-table th {
  padding: 10px 15px;
  font-weight: bold;
  text-transform: uppercase;
  font-size: 0.875em;
  text-align: left;
}

.styled-table th.actions-header {
  text-align: center;
}

.styled-table tbody {
  background-color: #ffffff;
}

.styled-table tbody tr {
  border-bottom: 1px solid #e0e0e0;
  height: 50px;
}

.styled-table tbody td {
  padding: 10px 15px;
  font-size: 0.875em;
  color: #333;
}

.styled-table tbody tr:nth-child(even) {
  background-color: #f9f9f9;
}

.styled-table tbody tr:hover {
  background-color: #f1f1f1;
}

.actions {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
}

.button {
  background-color: #4CAF50;
  color: white;
  padding: 8px 12px;
  border: none;
  border-radius: 4px;
  font-size: 0.875em;
  font-weight: 600;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.button-edit {
  background-color: #ffc107;
  color: black;
}

.button-edit:hover {
  background-color: #e0a800;
}

.button-delete {
  background-color: #dc3545;
  color: white;
}

.button-delete:hover {
  background-color: #c82333;
}

.button i {
  font-size: 1.2em;
}
</style>
