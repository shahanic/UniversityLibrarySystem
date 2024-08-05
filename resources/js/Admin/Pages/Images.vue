<template>
    <admin-layout>
      <template v-slot:main>
        <AddImageModal v-if="isAddImageModalOpen" />
        <div  class="p-6">
          <h1 class="text-2xl font-bold mb-4">Images</h1>
          <button @click="imageStore.openAddImageModal()" class="mb-4 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">Add Image</button>
          <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
            <thead class="bg-gray-300 text-black">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Type</th>
                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Image</th>
                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-center">Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white">
              <tr v-for="image in photos" :key="image.id" class="border-b even:bg-gray-100 hover:bg-gray-200">
                <td class="px-6 py-4 text-sm text-gray-900">{{ image.name }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ image.type }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">
                    <img :src="`/${image.src}`" :alt="image.name" class="w-16 h-16 object-cover rounded" />
                </td>
                <td class="px-6 py-4 text-sm text-gray-600 text-center flex justify-center gap-2">
                  <button @click="imageStore.deleteImage(image.id)" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
         
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
  const { fetchImages } = imageStore;
  const { photos, isAddImageModalOpen } = storeToRefs(imageStore);
  
  watchEffect(() => {
    fetchImages()
  })
console.log("dddddd")
console.log(route.fullPath);
  
  </script>
  