<template>
    <div class="container mx-auto p-4">
      <h1 class="text-2xl font-bold mb-4 text-center">Add New Article</h1>
      <div class="mb-6">
        <div class="col-span-2 mb-4">
          <h2 class="text-base font-bold">Title</h2>
          <textarea type="text"
            class="form-input border border-gray-300 rounded w-full"
            v-model="newArticle.title"
            placeholder="Title" required></textarea>
        </div>
        <div class="mb-4">
          <h2 class="text-base font-bold">Description</h2>
          <textarea type="text"
            class="form-input border border-gray-300 rounded w-full py-2 px-3"
            v-model="newArticle.abstract"
            placeholder="Abstract"></textarea>
        </div>
        <div class="mb-4">
          <h2 class="text-base font-bold">Content</h2>
          <textarea style="min-height: fit-content;" type="text"
            class="form-input border border-gray-300 rounded w-full py-2 px-3"
            v-model="newArticle.content"
            placeholder="Content"></textarea>
        </div>

        <div class="mb-4">
            <h2 class="text-base font-bold">Photo</h2>
            <input type="file" @change="handleFileUpload" multiple class="mb-3 w-full p-2 border rounded" />
        </div>  

        <!-- <div v-if="form.src.length">
        <h2 class="text-base font-bold mt-4">Uploaded Photos</h2>
        <div class="flex flex-wrap">
          {{ form.src }}
          <div v-for="(file, index) in form.src" :key="index" class="relative mr-4 mb-4">
            <img :src="URL.createObjectURL(file)" alt="Uploaded Photo" class="w-32 h-32 object-cover rounded" />
            <img v-if="file && typeof URL !== 'undefined' && URL.createObjectURL(file)" :src="URL.createObjectURL(file)" alt="Uploaded Photo" class="w-32 h-32 object-cover rounded" />
            <button @click="removePhoto(index)" class="absolute top-0 right-0 bg-red-500 text-white p-1 rounded-full">
              X
            </button>
          </div>
        </div>
      </div> -->

        <div> 
            <h2 class="text-base font-bold">Status</h2>
            <select v-model="newArticle.status" require>
                <option value="" disabled>Select status</option>
                <option value="1">Draft</option>
                <option value="0">Publish</option>
            </select>
        </div> <br> 
        <div> 
            <h2 class="text-base font-bold">Date</h2>
            <input v-model="newArticle.date" type="date" >
        </div> <br> 
          <form @submit.prevent="articlepage.addNewArticle">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">
              Save
            </button>
            <button
              @click="articlepage.cancel"
              type="button"
              class="bg-green-500 text-white px-4 py-2 rounded mt-4 ml-2"
              >
              Cancel
          </button>
          </form>
        </div>
      </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { articlesStore } from '@/Admin/Stores/articlepagesStores';
import { storeToRefs } from 'pinia';
import 'bootstrap-icons/font/bootstrap-icons.css';
// import { VDateInput } from 'vuetify/labs/VDateInput'
const props = defineProps({
data: {
type: Object,
required: true
},
});
const articlepage = articlesStore();
const { newArticle, form} = storeToRefs(articlepage);

function handleFileUpload(event) {
      articlepage.handleFileUpload(event);
    }
function removePhoto(index) {
  form.src.splice(index, 1);
}
// isVisible: {
//     type: Boolean,
//     required: true
//   }

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



<!-- 

// import { useImageStore } from '@/Admin/Stores/imagesStores';

// const imageStore = useImageStore();
// const { form } = storeToRefs(imageStore);

// function handleFileUpload(event) {
//   // imageStore.handleFileUpload(event);
//   const files = event.target.files;
//   if (files) {
//     form.value.src = Array.from(files); // Store the file objects in an array
//   }
// }
//   // Ensure `newArticle.title` is defined before processing
// function generateSlug() {
//   if (newArticle.value && newArticle.value.title) {
//     return newArticle.value.title
//       .toLowerCase()
//       .replace(/\s+/g, '-')
//       .replace(/[^\w\-]+/g, ''); // Remove non-word characters
//   }
//   return ''; // Return an empty string or a default value if title is not defined
// }


// function addNewArticle() {
//   newArticle.value.slug = generateSlug(newArticle.value.title); // Generate slug

//   if (newArticle.value) {
//     axios.post('/save-article', newArticle.value)
//       .then(response => {
//         const article = response.data;

//         // Proceed to upload images if any
//         if (form.value.src && form.value.src.length > 0) {
//           const formData = new FormData();
//           formData.append('gallery_id', article.gallery_id);
//           formData.append('name', article.title);
//           formData.append('slug', article.slug);
//           formData.append('type', '1'); // Add the type field with value 1

//           for (let i = 0; i < form.value.src.length; i++) {
//             formData.append('src[]', form.value.src[i]); // Append files to FormData
//           }

//           axios.post(`/save-images-art/${article.gallery_id}/${article.slug}`, formData, {
//             headers: {
//               'Content-Type': 'multipart/form-data'
//             }
//           })
//           .then(() => {
//             alert('Content and images saved successfully!');
//             // adding = false;
//           })
//           .catch(error => {
//             console.error('Error saving images:', error);
//             alert('Failed to save images.');
//           });
//         } else {
//           alert('Content saved successfully!');
//           // this.adding = false;
//         }
//       })
//       .catch(error => {
//         console.error('Error saving article:', error);
//         alert('Failed to save content.');
//       });
//   }
// }


// Function to add a new article
// function addNewArticle() {
//   newArticle.value.slug = generateSlug(newArticle.value.title); // Generate slug

//   if (newArticle.value) {
//     axios.post('/save-article', newArticle.value)
//       .then(response => {
//         const article = response.data;

//         // Proceed to upload images if any
//         if (form.value.src && form.value.src.length > 0) {
//           const formData = new FormData();
//           formData.append('gallery_id', article.gallery_id);
//           formData.append('name', article.title);
//           formData.append('slug', article.slug);
//           formData.append('type', '1'); // Add the type field with value 1

//           for (let i = 0; i < form.value.src.length; i++) {
//             formData.append('src[]', form.value.src[i]);
//           }

//           axios.post('/save-images', formData, {
//             headers: {
//               'Content-Type': 'multipart/form-data'
//             }
//           })
//           .then(() => {
//             alert('Content and images saved successfully!');
//             // adding = false;
//           })
//           .catch(error => {
//             console.error('Error saving images:', error);
//             alert('Failed to save images.');
//           });
//         } else {
//           alert('Content saved successfully!');
//           // this.adding = false;
//         }
//       })
//       .catch(error => {
//         console.error('Error saving article:', error);
//         alert('Failed to save content.');
//       });
//   }
// }
// articlepage.addNewArticle = async function() {
//   try {
//        // Generate the slug
//        newArticle.value.slug = generateSlug();
//     // Save the article first
//     const response = await axios.post('/save-article', newArticle.value);
//     const article = response.data;

//     if (form.value.src && form.value.src.length > 0) {
//       const formData = new FormData();
//       formData.append('gallery_id', article.gallery_id);
//       formData.append('name', article.title);
//       formData.append('slug', article.slug);
//       formData.append('type', '1'); // Add the type field with value 1

//       for (let i = 0; i < form.value.src.length; i++) {
//         formData.append('src[]', form.value.src[i]);
//       }

//       await axios.post('/save-images', formData, {
//         headers: {
//           'Content-Type': 'multipart/form-data'
//         }
//       });
//     }

    // Optionally, refresh the article list or navigate to another page
    // await this.fetchArticles();
//     this.$emit('close');
//   } catch (error) {
//     console.error('Error adding article:', error);
//   }
// }; -->