<template>
  <admin-layout>
    <template v-slot:main>
      <PreviewGenericPage v-if="preview" :data="newPage"></PreviewGenericPage>
      <AddGenericPage v-if="adding" :data="newPage"></AddGenericPage>
      <EditGenericPage v-if="editing" :data="genericpages.currentPage"></EditGenericPage>
      <div v-if="!editing && !adding && !preview" style="width: 90%; margin: 0 auto; margin-top: 2%;">
        <div>
          <h2 style="text-align: center; margin-bottom: 10px;">Generic Pages</h2>
          <button style="  text-align: left; margin-bottom: 20px;" @click="genericpages.addPage(newPage)" class="button button-add">ADD NEW PAGE</button>
        </div>
       
        <div v-if="genericpages.generics.length">
         
          <table class="styled-table">
            <thead>
              <tr>
                <th>Title</th>
                <th>Submenu</th>
                <th class="actions-header">Actions</th>
              </tr>
            </thead>
            <tbody>
              
              <tr v-for="item in genericpages.generics" :key="item.id">                
                <td>{{ item.title }}</td>
                <td>{{ item.submenu }}</td>
                <td class="actions">
                  <button @click="genericpages.previewContent(item.id)" class="button button-preview">
                    <i class="bi bi-eye" style="margin-right: 8px;"></i>Preview
                  </button>
                  <button @click="genericpages.editPage(item)" class="button button-edit">
                    <i class="bi bi-pencil-square"></i>
                  </button>
                  <button @click="genericpages.deletePages(item, 0)" class="button button-delete">
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
import EditGenericPage from '@/Admin/Pages/EditGenericPage.vue'
import AddGenericPage from '@/Admin/Pages/SaveGeneric.vue'
import PreviewGenericPage from '@/Admin/Pages/PreviewGenericPage.vue'

import { onMounted, watchEffect, watch } from 'vue';
import { genericpagesStore } from '@/Admin/Stores/genericpagesStores';
import { storeToRefs } from 'pinia';

const genericpages = genericpagesStore();
const {currentPage, newPage, editing, adding, preview} = storeToRefs(genericpages);

watchEffect(() => {
  genericpages.fetchPagesData();
});

const handleReload = (newVal, oldVal) => {
      if (oldVal === true && newVal === false) {
        genericpages.fetchPagesData();
      }
};
watch(editing, handleReload);
watch(adding, handleReload);
watch(preview, handleReload);

// const deletePage = (item) => {
//   if (confirm('Are you sure you want to delete this page?')) {
//     genericpages.deletePages(item.id);
//   }
//   genericpages.fetchPagesData();
// };
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
