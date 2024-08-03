<template>
  <admin-layout>
    <template v-slot:main>
      <PreviewGenericPage v-if="preview" :data="newPage"></PreviewGenericPage>
      <AddGenericPage v-if="adding" :data="newPage"></AddGenericPage>
      <EditGenericPage v-if="editing" :data="genericpages.currentPage"></EditGenericPage>
      <div v-if="!editing && !adding && !preview" style="width: 90%; margin: 0 auto; margin-top: 2%;">
        <div>
          <h2 style="text-align: center; margin-bottom: 10px;">Generic Pages</h2>
          <button style="  text-align: left; margin-bottom: 20px;" @click="genericpages.addPage(genericpages.newPage, 1)" class="button button-add">ADD NEW PAGE</button>
        </div>
      
        <div v-if="genericpages.generics.length">
          <table class="styled-table">
            <thead>
              <tr>
                <th class="header-cell">Title</th>
                <th class="header-cell">Submenu</th>
                <th class="header-cell">Status</th>
                <th style="width: 50%; font-weight: bold; text-transform: uppercase; font-size: 0.875em;">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in genericpages.generics" :key="item.id" class="table-row">
                <td class="table-cell">{{ item.title }}</td>
                <td class="table-cell">{{ item.submenu }}</td>
                <td class="table-cell">{{ item.status === 1 ? 'Drafted' : 'Published' }}</td>

                <td class="table-cell actions">
                  <button @click="genericpages.previewContent(item.id)" class="button button-preview">
                    <i class="bi bi-eye" style="margin-right: 8px;"></i>Preview
                  </button>
                  <button @click="genericpages.editPage(item)" class="button button-edit">
                    <i class="bi bi-pencil-square"></i>
                  </button>
                  <button @click="deletePages(item, 1)" class="button button-delete">
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

import { useRoute } from 'vue-router';
import { onMounted, ref, watchEffect, watch } from 'vue';
import { genericpagesStore } from '@/Admin/Stores/genericpagesStores';
import { storeToRefs } from 'pinia';

const route = useRoute();
const genericpages = genericpagesStore();
const { fetchPageData, deletePages } = genericpages;
const {currentPage, editing, adding, preview, newPage } = storeToRefs(genericpages);
const subnav_id = route.params.id;


  
watchEffect(() => {
  fetchPageData(subnav_id);
  genericpages.newPage.sub_menu_id = subnav_id;
});

const handleReload = (newVal, oldVal) => {
      if (oldVal === true && newVal === false) {
        genericpages.fetchPageData(subnav_id);
      }
};
watch(editing, handleReload);
watch(adding, handleReload);

// const deletePage = (id) => {
//   deletePages(id);
//   fetchPageData(subnav_id);
// };
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

.button-view {
  background-color: #4CAF50;
}

.button-view:hover {
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

.input-text {
  width: 100%;
  border-radius: 4px;
  border: 1px solid #ccc;
  padding: 8px;
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

.modal-header {
  text-align: center;
  margin-bottom: 20px;
}
</style>

