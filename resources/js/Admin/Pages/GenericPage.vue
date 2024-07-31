<template>
  <admin-layout>
    <template v-slot:main>
      <div class="main-container">
        <h2 class="header-title">Generic Pages</h2>
     
        <router-link :to="{ name: 'SaveGeneric' }" class="button button-add">Add New Page</router-link>
        <br><br>

        <div v-if="genericpages.generics.length">
          <table class="styled-table">
            <thead>
              <tr>
                <th class="header-cell">Title</th>
                <th class="header-cell">Submenu</th>
                <th class="header-cell">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in genericpages.generics" :key="item.id" class="table-row">
                <td class="table-cell" style="width: 30%">{{ item.title }}</td>
                <td class="table-cell" style="width: 48%">{{ item.submenu }}</td>
                <td class="table-cell actions">
                  <router-link :to="{ name: 'EditGenericPage', params: { id: item.id } }" class="button button-edit">
                    <i class="bi bi-pencil-square"></i>
                  </router-link>
                  <button @click="deletePage(item)" class="button button-delete">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </template>
  </admin-layout>
</template>

<script setup>
import { useRoute } from 'vue-router';
import { onMounted, ref, watchEffect } from 'vue';
import { genericpagesStore } from '@/Admin/Stores/genericpagesStores';
import { storeToRefs } from 'pinia';

const route = useRoute();
const genericpages = genericpagesStore();
const { form, currentPage } = storeToRefs(genericpages);
const id = route.params.id;

watchEffect(() => {
  genericpages.fetchPageData(id);
});

const deletePage = (page) => {
  if (confirm('Are you sure you want to delete this page?')) {
    genericpages.deletePages(page.id);
    genericpages.fetchPageData(id);
  }
};
</script>

<style scoped>
.main-container {
  width: 90%;
  margin: 0 auto;
  margin-top: 2%;
}

.header-title {
  text-align: center;
  margin-bottom: 10px;
  font-size: 1.2em;
  font-weight: bold;
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

.button-add {
  margin-bottom: 20px;
}

.button-add:hover {
  background-color: #45a049;
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
}

.button-delete:hover {
  background-color: #c82333;
}

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

.header-cell {
  padding: 10px 15px;
  font-weight: bold;
  text-transform: uppercase;
  font-size: 0.875em;
  text-align: left;
}

.table-cell {
  padding: 10px 15px;
  font-size: 0.875em;
  color: #333;
}

.table-row {
  border-bottom: 1px solid #e0e0e0;
  height: 50px;
}

.table-row:nth-child(even) {
  background-color: #f9f9f9;
}

.table-row:hover {
  background-color: #f1f1f1;
}

.actions {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
}
</style>
