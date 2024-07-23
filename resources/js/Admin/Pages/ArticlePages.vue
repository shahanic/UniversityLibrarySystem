<template>
    <admin-layout>
        <template v-slot:main>
            <div class="container mx-auto p-4">
                <h1 class="text-2xl font-bold mb-4 text-center">Generic Pages</h1>
                
                <!-- <input
                  type="text"
                  placeholder="Search..."
                  class="border rounded p-2 mb-4 w-full"
                /> -->

                <table class="min-w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-400">
                            <th class="border border-gray-300 text-white p-2">ID</th>
                            <th class="border border-gray-300 text-white p-2">Name</th>
                            <th class="border border-gray-300 text-white p-2">Main Navigation</th>
                            <th class="border border-gray-300 text-white p-2">Subnavigation</th>
                            <th class="border border-gray-300 text-white p-2">Order</th>
                            <th class="border border-gray-300 text-white p-2">Status</th>
                            <th class="border border-gray-300 text-white p-2">Created By</th>
                            <th class="border border-gray-300 text-white p-2">Modified By</th>
                            <th class="border border-gray-300 p-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td class="border border-gray-300 p-2"></td>
                            <td class="border border-gray-300 p-2"></td>
                            <td class="border border-gray-300 p-2"></td>
                            <td class="border border-gray-300 p-2"></td>
                            <td class="border border-gray-300 p-2"></td>
                            <td class="border border-gray-300 p-2"></td>
                            <td class="border border-gray-300 p-2"></td>
                            <td class="border border-gray-300 p-2"></td>
                            <td colspan="9" class="text-center py-4">
                            <button @click="togglePreview" class="bg-green-500 text-white px-4 py-2 rounded">PREVIEW</button>
                            <button @click="toggleEditor" class="bg-yellow-500 text-white px-4 py-2 rounded">EDIT</button>
                            </td>
                        </tr>
                        <!-- <tr>
                            <td class="border border-gray-300 p-2"></td>
                            <td class="border border-gray-300 p-2"></td>
                            <td class="border border-gray-300 p-2"></td>
                            <td class="border border-gray-300 p-2"></td>
                            <td class="border border-gray-300 p-2"></td>
                            <td class="border border-gray-300 p-2"></td>
                            <td class="border border-gray-300 p-2"></td>
                            <td class="border border-gray-300 p-2"></td>
                            <td class="border border-gray-300 p-2 " style="width: 18%;">
                                <button class="bg-green-900 text-white px-2 py-1 rounded mr-3">PREVIEW</button>
                                <button class="bg-yellow-500 text-gray px-2 py-1 rounded mr-3">EDIT</button>
                            </td>
                        </tr> -->

                    </tbody>
                </table>
        
                <div v-if="isPreview" class="mt-4 p-4 border rounded">
                    <div v-html="editorData"></div>
                </div>
                <div v-if="isEdit" class="mt-4">
                    <ckeditor :editor="editor" v-model="editorData"></ckeditor>
                    <button @click="saveContent" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">SAVE</button>
                </div>
        </div>
        </template>
    </admin-layout>
</template>

<style scoped>
.container {
    max-width: 1500px;
}
</style>


<script>
  import CKEditor from '@ckeditor/ckeditor5-vue';
  import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
  
  export default {
    components: {
      ckeditor: CKEditor.component
    },
    data() {
      return {
        isPreview: false,
        isEdit: false,
        editor: ClassicEditor,
        editorData: ''
      };
    },
    methods: {
      // Added togglePreview method
      togglePreview() {
        this.isPreview = !this.isPreview;
        this.isEdit = false;
      },
      // Added toggleEditor method
      toggleEditor() {
        this.isEdit = !this.isEdit;
        this.isPreview = false;
      },
      saveContent() {
        // Simulate saving data to a CMS
        console.log('Saving data to CMS:', this.editorData);
        alert('Content saved successfully!');
      }
    }
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

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}

h2 {
  margin: 0;
  font-size: 1.2em;
  font-weight: bold;
  padding-left: 7px;
  text-align: center;
}

.view-details {
  text-decoration: none;
  color: #007BFF;
  font-size: 0.9em;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #eee;
}

th {
  font-weight: normal;
  color: #666;
}

.avatar {
  border-radius: 50%;
  width: 32px;
  height: 32px;
  margin-right: 8px;
  vertical-align: middle;
}

.leave {
  color: #FF4500;
}

.negative {
  color: #FF4500;
}

.positive {
  color: #4CAF50;
}
</style>