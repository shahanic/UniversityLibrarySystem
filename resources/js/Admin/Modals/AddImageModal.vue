<template>
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" @click.self="$emit('close')">
      <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
        <h2 class="text-xl font-semibold mb-4 text-center">Add Image</h2>
        <form @submit.prevent="imageStore.addImage">
          <input v-model="form.name" placeholder="Name" required class="w-full mb-3 p-2 border rounded" />
          <input v-model="form.type" placeholder="Type" required class="w-full mb-3 p-2 border rounded" />
          <input type="file" @change="handleFileUpload" required class="mb-3 w-full p-2 border rounded" />
          <div class="flex justify-between">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">Save</button>
            <button type="button" @click="$emit('close')" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-gray-700 transition">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script setup>
  import { useImageStore } from '@/Admin/Stores/imagesStores';
  import { storeToRefs } from 'pinia';
  
  const imageStore = useImageStore();
  const { form } = storeToRefs(imageStore);
  
  function handleFileUpload(event) {
    imageStore.handleFileUpload(event);
  }
  </script>
  