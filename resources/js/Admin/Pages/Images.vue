<template>
  <admin-layout>
    <template v-slot:main>
      <div style="width: 90%; margin: 0 auto; margin-top: 2%;">
        <AddImageModal v-if="isAddImageModalOpen" />
        
        <h1 style="text-align: center; margin-bottom: 10px;">Images</h1>
        
        <button @click="imageStore.openAddImageModal()" class="button button-add">Add Image</button>

        <div v-if="imageStore.photos.length" style="margin-top: 20px;">
          <table class="styled-table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Image</th>
                <th class="actions-header">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="image in imageStore.photos" :key="image.id">
                <td>{{ image.name }}</td>
                <td>{{ image.type }}</td>
                <td>
                  <img :src="`/${image.src}`" :alt="image.name" class="w-16 h-16 object-cover rounded" />
                </td>
                <td class="actions">
                  <button @click="imageStore.deleteImage(image)" class="button button-delete">
                    Delete
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
import { useImageStore } from '@/Admin/Stores/imagesStores';
import { storeToRefs } from 'pinia';
import AddImageModal from '@/Admin/Modals/AddImageModal.vue';
import { watchEffect } from 'vue';
import { useRoute } from 'vue-router';
const route = useRoute();

const imageStore = useImageStore();
const { isAddImageModalOpen } = storeToRefs(imageStore);

const id = route.params.id;

watchEffect(() => {
  const galid = route.params.id;
  imageStore.fetchImages(galid);
});
</script>

<style scoped>
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

.button-delete {
  background-color: #dc3545;
  color: white;
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
</style>
