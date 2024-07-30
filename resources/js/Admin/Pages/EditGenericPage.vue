<template>
  <admin-layout>
    <template v-slot:main>
      <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4 text-center">Edit Page</h1>
        <div v-if="currentPage" class="mb-6">
          <div class="col-span-2 mb-4">
            <h2 class="text-base font-bold">Title</h2>
            <textarea
              type="text"
              class="form-input border border-gray-300 rounded w-full"
              v-model="currentPage.title"
              placeholder="Title"
            ></textarea>
          </div>
          <div class="mb-4">
            <h2 class="text-base font-bold">Abstract</h2>
            <textarea
              type="text"
              class="form-input border border-gray-300 rounded w-full py-2 px-3"
              v-model="currentPage.abstract"
              placeholder="Abstract"
            ></textarea>
          </div>
          <div class="mb-4">
            <h2 class="text-base font-bold">Content</h2>
            <div class="editor-container" ref="editorContainerElement">
              <ckeditor
                :editor="editor"
                v-model="currentPage.content"
                :config="editorConfig"
                v-if="isLayoutReady"
              ></ckeditor>
            </div>
            <form @submit.prevent="savePage()">
              <button
                type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded mt-4"
              >
                Save
              </button>
              <button
                @click="deletePage"
                type="button"
                class="bg-red-500 text-white px-4 py-2 rounded mt-4 ml-2"
              >
                Delete
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
import { useRoute } from 'vue-router';
import { genericpagesStore } from '@/Admin/Stores/genericpagesStores';
import { storeToRefs } from 'pinia';
import {ckStore} from '@/Admin/Stores/ckeditor';

const ck = ckStore();

// Access the Pinia store
const genericpages = genericpagesStore();
const { currentPage, isLayoutReady } = storeToRefs(genericpages);
const { editor, editorConfig } = storeToRefs(ck);



// route const
const route = useRoute();

// Automatically edit each article when the component is mounted
onMounted(() => {
  const id = route.params.id;  // Get ID from route params
  if (id) {
      genericpages.editPageData(id);
  }
});

function savePage() {
  if (currentPage.value) {
    genericpages.save().then(() => {
      router.push('/generic-pages');  // Navigate to GenericPages route
    });
    window.location.href = '/generic-pages';
  }
}

function deletePage() {
  if (currentPage.value && confirm('Are you sure you want to delete this article?')) {
      genericpages.deletePages(currentPage.value.id);
  }
}
</script>


<style>
/* @import url('https://fonts.googleapis.com/css2?family=Oswald&family=PT+Serif:ital,wght@0,400;0,700;1,400&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400;1,700&display=swap');

@media print {
	body {
		margin: 0 !important;
	}
}

.main-container {
	font-family: 'Lato';
	width: fit-content;
	margin-left: auto;
	margin-right: auto;
}

.ck-content {
	font-family: 'Lato';
	line-height: 1.6;
	word-break: break-word;
}

.editor-container_classic-editor .editor-container__editor {
	min-width: 795px;
	max-width: 795px;
}

.editor-container_include-block-toolbar {
	margin-left: 42px;
}

.ck-content h3.category {
	font-family: 'Oswald';
	font-size: 20px;
	font-weight: bold;
	color: #555;
	letter-spacing: 10px;
	margin: 0;
	padding: 0;
}

.ck-content h2.document-title {
	font-family: 'Oswald';
	font-size: 50px;
	font-weight: bold;
	margin: 0;
	padding: 0;
	border: 0;
}

.ck-content h3.document-subtitle {
	font-family: 'Oswald';
	font-size: 20px;
	color: #555;
	margin: 0 0 1em;
	font-weight: bold;
	padding: 0;
}

.ck-content p.info-box {
	--background-size: 30px;
	--background-color: #e91e63;
	padding: 1.2em 2em;
	border: 1px solid var(--background-color);
	background: linear-gradient(
			135deg,
			var(--background-color) 0%,
			var(--background-color) var(--background-size),
			transparent var(--background-size)
		),
		linear-gradient(
			135deg,
			transparent calc(100% - var(--background-size)),
			var(--background-color) calc(100% - var(--background-size)),
			var(--background-color)
		);
	border-radius: 10px;
	margin: 1.5em 2em;
	box-shadow: 5px 5px 0 #ffe6ef;
}

.ck-content blockquote.side-quote {
	font-family: 'Oswald';
	font-style: normal;
	float: right;
	width: 35%;
	position: relative;
	border: 0;
	overflow: visible;
	z-index: 1;
	margin-left: 1em;
}

.ck-content blockquote.side-quote::before {
	content: '“';
	position: absolute;
	top: -37px;
	left: -10px;
	display: block;
	font-size: 200px;
	color: #e7e7e7;
	z-index: -1;
	line-height: 1;
}

.ck-content blockquote.side-quote p {
	font-size: 2em;
	line-height: 1;
}

.ck-content blockquote.side-quote p:last-child:not(:first-child) {
	font-size: 1.3em;
	text-align: right;
	color: #555;
}

.ck-content span.marker {
	background: yellow;
}

.ck-content span.spoiler {
	background: #000;
	color: #000;
}

.ck-content span.spoiler:hover {
	background: #000;
	color: #fff;
}

.ck-content pre.fancy-code {
	border: 0;
	margin-left: 2em;
	margin-right: 2em;
	border-radius: 10px;
}

.ck-content pre.fancy-code::before {
	content: '';
	display: block;
	height: 13px;
	background: url(data:image/svg+xml;base64,PHN2ZyBmaWxsPSJub25lIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA1NCAxMyI+CiAgPGNpcmNsZSBjeD0iNi41IiBjeT0iNi41IiByPSI2LjUiIGZpbGw9IiNGMzZCNUMiLz4KICA8Y2lyY2xlIGN4PSIyNi41IiBjeT0iNi41IiByPSI2LjUiIGZpbGw9IiNGOUJFNEQiLz4KICA8Y2lyY2xlIGN4PSI0Ny41IiBjeT0iNi41IiByPSI2LjUiIGZpbGw9IiM1NkM0NTMiLz4KPC9zdmc+Cg==);
	margin-bottom: 8px;
	background-repeat: no-repeat;
}

.ck-content pre.fancy-code-dark {
	background: #272822;
	color: #fff;
	box-shadow: 5px 5px 0 #0000001f;
}

.ck-content pre.fancy-code-bright {
	background: #dddfe0;
	color: #000;
	box-shadow: 5px 5px 0 #b3b3b3;
} */
 /* Include custom styles for CKEditor */



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

/* .ck-content>ul {
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
} */
</style>
