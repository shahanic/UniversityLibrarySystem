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
                v-model="genericpages.newPage.title"
                placeholder="Title"></textarea>
            </div>
            <div class="mb-4">
              <h2 class="text-base font-bold">Abstract</h2>
              <textarea type="text"
                class="form-input border border-gray-300 rounded w-full py-2 px-3"
                v-model="newPage.abstract"
                placeholder="Abstract"></textarea>
            </div>
            <div>
              <select name="" id="">
                <option v-for="submenu in sub_menus" v-bind:value="submenu.value">{{submenu.value}}</option>
              </select>
              
            </div>
            <div class="mb-4">
              <h2 class="text-base font-bold">Content</h2>
              <div class="editor-container" ref="editorContainerElement">
                <ckeditor
                  :editor="editor"
                  v-model="newPage.content"
                  :config="editorConfig"
                  v-if="isLayoutReady"
                ></ckeditor>
              </div>
              <form @submit.prevent="savePage()">
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
  import { onMounted } from 'vue';
  import { useRoute } from 'vue-router'
  import { genericpagesStore } from '@/Admin/Stores/genericpagesStores';
  import { storeToRefs } from 'pinia';
  import {ckStore} from '@/Admin/Stores/ckeditor';

  // Access the Pinia store
  const ck = ckStore();
  const genericpages = genericpagesStore();
  const { newPage, isLayoutReady } = storeToRefs(genericpages);
  const { editor, editorConfig } = storeToRefs(ck);
  const route = useRoute();

  onMounted(() => {
    genericpages.fetchPagesData();
  });

  const savePage = () => {
    const id = route.params.id;
    if (newPage.value) {
      genericpages.addPageData(id);
      window.location.href= `/generic-page/${id}`;
    } 
  };
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
  