<template>
    <admin-layout>
      <template v-slot:main>
        <div class="container mx-auto p-4">
          <h1 class="text-2xl font-bold mb-4 text-center">Article Page</h1>
          <div class="col-span-2">
              <h2 class="text-base font-bold">Title</h2>
              <input type="text" class="form-input border border-gray-300 rounded w-full" v-model="title" placeholder="Title" /> <br><br>
          </div>
          <div>
              <h2 class="text-base font-bold">Abstract</h2>
              <input list="positions" class="form-input border border-gray-300 rounded w-full py-2 px-3" v-model="abstract" placeholder="Ex. Developer" />
          </div>
          <div>
            <h2 class="text-base font-bold">Content</h2>
            <form @submit.prevent="saveContent">
              <ckeditor 
              :editor="editor" v-model="content" 
              :config="editorConfig"
              ></ckeditor>
              <button
  
                type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded mt-4">
                Save
              </button>
            </form>
          </div>
        </div>
      </template>
    </admin-layout>
  </template>



<script setup>
  import {articlesStore} from '@/Admin/Stores/articlepagesStores';
  import CKEditor from '@ckeditor/ckeditor5-vue';
  import {storeToRefs} from 'pinia';
  import { ref   } from "vue";

  // Access the Pinia store
  const articlepagestore = articlesStore()
  // const { editor, editorConfig, title, abstract, content } = storeToRefs(articlepagestore);


  // Local state
  const title = ref('');
  const abstract = ref('');
  const content = ref('');
  const editor = ref(articlepagestore.editor);
  const editorConfig = ref(articlepagestore.editorConfig);


  console.log('Editor:', editor.value);
  console.log('Editor Config:', editorConfig.value);
  console.log('Title:', title.value);
  console.log('Abstract:', abstract.value);
  console.log('Content:', content.value);
  // Fetch initial data from the store
  articlepagestore.getter();

  function saveContent() {
  console.log('Saving content:', form.content);
  articlepagestore.save();
  alert('Content saved successfully!');
}
  </script>









<!-- <script>
import { ref } from 'vue';
import { articlesStore } from '@/Admin/Stores/articlepagesStores';
import { storeToRefs } from 'pinia';

import CKEditor from "@ckeditor/ckeditor5-vue";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

// Access the Pinia store
const articlepagestore = articlesStore()

// Fetch initial data from the store
articlepagestore.getter();

const editor = {
  editor: ClassicEditor,
      editorData: "<p>Hello from CKEditor 5!</p>",
      editorConfig: {
        tabSpaces: 4,
        toolbar: {
                  items: [
                      'undo', 'redo',
                      '|', 'heading',
                      '|', 'bold', 'italic', 'numbered',
                      '|', 'bulletedList', 'numberedList', 'outdent', 'indent'
                  ]
                    }
      },
}


function saveContent() {
  console.log('Saving content:', form.content);
  articlepagestore.save();
  alert('Content saved successfully!');
}

</script> -->


<!-- <script setup>
import {articlesStore} from '@/Admin/Stores/articlepagesStores';
import {storeToRefs} from 'pinia';

// Access the Pinia store
const articlepagestore = articlesStore()
const{form} = storeToRefs(articlepagestore)  

// Fetch initial data from the store
articlepagestore.getter();

import { ref } from 'vue';
import CKEditor from '@ckeditor/ckeditor5-vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

// Initialize CKEditor
const editor = ClassicEditor;
const articlepage = ref({
  title: '',
  content: '',
});

const editorConfig = {
  tabSpaces: 4,
  toolbar: {
    items: [
      'undo',
      'redo',
      '|',
      'heading',
      '|',
      'bold',
      'italic',
      'numbered',
      '|',
      'bulletedList',
      'numberedList',
      'outdent',
      'indent',
    ],
  },
};

// Method to save content
function saveContent() {
  console.log('Saving content:', articlepage.value.content);
  alert('Content saved successfully!');
}
</script> -->

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

.ck-content>ul {
    display: block;
    list-style-type: disc;
    margin-top: 1em;
    margin-bottom: 1em;
    margin-left: 0;
    margin-right: 0;
    padding-left: 40px;
}

.ck-content>ol {
    display: block;
    list-style-type: decimal;
    margin-top: 1em;
    margin-bottom: 1em;
    margin-left: 0;
    margin-right: 0;
    padding-left: 40px;
}

.ck>h1 {
    display: block;
    font-size: 2em;
    margin-top: 0.67em;
    margin-bottom: 0.67em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
}

.ck>h2 {
    display: block;
    font-size: 1.5em;
    margin-top: 0.83em;
    margin-bottom: 0.83em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
}

.ck>h3 {
    display: block;
    font-size: 1.17em;
    margin-top: 1em;
    margin-bottom: 1em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
}

.ck>h4 {
    display: block;
    font-size: 1em;
    margin-top: 1.33em;
    margin-bottom: 1.33em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
}

.ck>h5 {
    display: block;
    font-size: 0.83em;
    margin-top: 1.67em;
    margin-bottom: 1.67em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
}

.ck>h6 {
    display: block;
    font-size: 0.67em;
    margin-top: 2.33em;
    margin-bottom: 2.33em;
    margin-left: 0;
    margin-right: 0;
    font-weight: bold;
}
</style>
