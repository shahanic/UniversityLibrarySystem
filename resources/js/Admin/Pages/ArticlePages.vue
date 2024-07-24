<template>
  <admin-layout>
    <template v-slot:main>
      <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4 text-center">Article Pages</h2>
        
        <form @submit.prevent="saveContent">
          <ckeditor
            :editor="editor"
            v-model="editorData"
            :config="editorConfig"
          ></ckeditor>
          <button
            type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded mt-4">
            Save
          </button>
        </form>
      </div>
    </template>
  </admin-layout>
</template>

<script>
import CKEditor from "@ckeditor/ckeditor5-vue";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

export default {
  components: {
    ckeditor: CKEditor.component,
  },
  data() {
    return {
      editor: ClassicEditor,
      editorData: "<p>Hello from CKEditor 5!</p>",
      editorConfig: {
        toolbar: [
          'undo',
          'redo',
          '|',
          'bold',
          'italic',
          '|',
          'fontSize',
          'fontFamily',
          'fontColor',
          'fontBackgroundColor',
          '|',
          'numberedList',
          'bulletedList', // Add list items here
        ],
      },
    };
  },
  methods: {
    saveContent() {
      // This is where you would handle saving the editor data, e.g., sending it to a server
      console.log("Saving content:", this.editorData);
      alert("Content saved successfully!");
    },
  },
};
</script>

<style scoped>
.container {
  width: 100%;
  padding: 100px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  background-color: #fff;
}

h2 {
  margin: 0;
  font-size: 1.2em;
  font-weight: bold;
  padding-left: 7px;
  text-align: center;
}

.ck-editor__editable {
  min-height: 400px; /* Ensure there's enough space */
  width: 100%; /* Ensure full width */
  box-sizing: border-box; /* Include padding and border in width/height */
}

.ck-toolbar {
  overflow: visible; /* Ensure toolbar is not clipped */
}

.ck-toolbar__items {
  white-space: nowrap; /* Prevent toolbar items from wrapping */
}

.ck-content ul,
.ck-content ol {
  padding-left: 2em; /* Ensure bullets and numbers have space */
}
/* Ensure the CKEditor editor itself is not constrained by parent elements */
.ck-editor {
  width: 100%; /* Full width */
  box-sizing: border-box; /* Include padding and border */
}

</style>
