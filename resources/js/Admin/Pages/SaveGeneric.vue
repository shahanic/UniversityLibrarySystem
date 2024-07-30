<template>
    <admin-layout>
      <template v-slot:main>
        <div class="container mx-auto p-4">
          <h1 class="text-2xl font-bold mb-4 text-center">Add New Page</h1>
          <div class="mb-6">
            <div class="col-span-2 mb-4">
              <h2 class="text-base font-bold">Title</h2>
              <textarea type="text"
                class="form-input border border-gray-300 rounded w-full"
                v-model="newPage.title"
                placeholder="Title"></textarea>
            </div>
            <div class="mb-4">
              <h2 class="text-base font-bold">Abstract</h2>
              <textarea type="text"
                class="form-input border border-gray-300 rounded w-full py-2 px-3"
                v-model="newPage.abstract"
                placeholder="Abstract"></textarea>
            </div>
            <div class="mb-4">
              <h2 class="text-base font-bold">Content</h2>
              <form @submit.prevent="savePage()">
                <ckeditor :editor="editor" v-model="newPage.content" :config="editorConfig"></ckeditor>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">
                  Save
                </button>
              </form>
            </div>
          </div>
        </div>
      </template>
    </admin-layout>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import CKEditor from '@ckeditor/ckeditor5-vue';
  import { genericpagesStore } from '@/Admin/Stores/genericpagesStores';
  import { storeToRefs } from 'pinia';
  
  const genericpages = genericpagesStore();
  const { editor, editorConfig } = storeToRefs(genericpages);
  
  const newPage = ref({
    title: '',
    abstract: '',
    content: ''
  });
  
  function savePage() {
    if (genericpages.form) {
        genericpages.addPage(genericpages.form);
    }
}

  </script>
  
  <style>
  .container {
    width: 100%;
    padding: 100px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    background-color: #fff;
  }
  
  h1 {
    margin: 0;
    font-size: 1.2em;
    font-weight: bold;
    padding-left: 7px;
    text-align: center;
  }
  
  h2 {
    margin: 0;
    font-size: 1.2em;
    font-weight: bold;
    padding-left: 7px;
    text-align: left;
  }
  </style>
  