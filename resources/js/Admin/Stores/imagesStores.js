import { defineStore } from 'pinia';
import axios from 'axios';

export const useImageStore = defineStore('imagesStores', {
  state: () => ({
    photos: [],
    isAddImageModalOpen: false,
    form: {
      name: '',
      type: '',
      src: [],
    },
  }),
  actions: {
    // async fetchImages() {
    //   try {
    //     const response = await axios.post('/get-images');
    //     this.photos = response.data;
    //   } catch (error) {
    //     console.error('Error fetching images:', error);
    //   }
    // },
    // fetchImages(){
    //     axios.post('/get-images').then(({data})=>{
    //         this.photos = data;
    //     })
    // },

    fetchImages() {
      axios.post('/get-images')
        .then(response => {
          // Handle the response to update images in the store
          this.photos = response.data;
          console.log(this.photos[0]);
        })
        .catch(error => {
          console.error('Error fetching images:', error);
        });
    },
    // async addImage() {
    //   if (!this.form.src) {
    //     console.error('No file selected.');
    //     return;
    //   }

    //   try {
    //     const formData = new FormData();
    //     formData.append('name', this.form.name);
    //     formData.append('type', this.form.type);
    //     formData.append('src', this.form.src); // Ensure this is the file object

    //     await axios.post('/save-image', formData, {
    //       headers: {
    //         'Content-Type': 'multipart/form-data'
    //       }
    //     });
    //     await this.fetchImages(); // Refresh the list after adding
    //     this.closeAddImageModal(); // Close the modal
    //   } catch (error) {
    //     console.error('Error adding image:', error);
    //   }
    // },

    addImage() {
      if (!this.form.src || this.form.src.length === 0) {
          console.error('No files selected.');
          return;
      }
  
      const formData = new FormData();
      formData.append('name', this.form.name);
      formData.append('type', this.form.type);
  
      // Append all selected files to the FormData
      for (let i = 0; i < this.form.src.length; i++) {
          formData.append('src[]', this.form.src[i]);
      }
  
      axios.post('/save-images', formData, {
          headers: {
              'Content-Type': 'multipart/form-data'
          }
      })
      .then(response => {
          console.log('Images added successfully');
          this.fetchImages(); // Refresh the list after adding
          this.closeAddImageModal(); // Close the modal
      })
      .catch(error => {
          console.error('Error adding images:', error);
      });
  },

    async deleteImage(id) {
      if (!id) return;
      try {
        await axios.post('/delete-image', { id });
        await this.fetchImages(); // Refresh the list after deleting
      } catch (error) {
        console.error('Error deleting image:', error);
      }
    },

    openAddImageModal() {
      this.isAddImageModalOpen = true;
    },

    closeAddImageModal() {
      this.isAddImageModalOpen = false;
      // Reset the form
      this.form = {
        name: '',
        type: '',
        src: null // Reset to null
      };
    },

  //   handleFileUpload(event) {
  //     const file = event.target.files[0];
  //     if (file) {
  //       this.form.src = file; // Store the file object directly
  //     }
  //   },
  //
      handleFileUpload(event) {
        const files = event.target.files;
        if (files) {
            this.form.src = Array.from(files); // Store the file objects in an array
        }
      },
    },
});
