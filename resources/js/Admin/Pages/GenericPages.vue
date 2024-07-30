<template>
  <admin-layout>
    <template v-slot:main>
      <div style="width: 90%; margin: 0 auto; margin-top: 2%;">
        <h2 style="text-align: center; margin-bottom: 10px;">Generic Pages</h2>
        <div v-if="genericpages.allgenerics.length">
          <table class="styled-table">
            <thead>
              <tr>
                <th>Title</th>
                <th>Submenu</th>
                <th class="actions-header">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in genericpages.allgenerics" :key="item.id">
                <td>{{ item.title }}</td>
                <td>{{ item.submenu }}</td>
                <td class="actions">
                  <router-link :to="{ name: 'EditGenericPage', params: { id: item.id } }" custom v-slot="{ navigate }">
                    <button @click="navigate" class="button button-edit">
                      <i class="bi bi-pencil-square"></i>
                    </button>
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
import { onMounted } from 'vue';
import { genericpagesStore } from '@/Admin/Stores/genericpagesStores';
import { storeToRefs } from 'pinia';

const genericpages = genericpagesStore();
const { currentPage } = storeToRefs(genericpages);

onMounted(() => {
  genericpages.fetchPagesData();
});

const deletePage = (item) => {
  if (confirm('Are you sure you want to delete this page?')) {
    genericpages.deletePages(item.id);
  }
};
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
