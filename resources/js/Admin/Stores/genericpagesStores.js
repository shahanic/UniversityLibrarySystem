import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import axios from "axios";
import { defineStore } from "pinia";
import { ref } from "vue";

export const genericpagesStore = defineStore('generics', {
    state: () =>{
        return{
            editor: ClassicEditor,
            editorConfig: {
            toolbar: ['undo', 'redo', '|', 'heading', '|', 'bold', 'italic', '|', 'bulletedList', 'numberedList', '|', 'blockQuote'],
            },
            form:{
                title:'',
                slug: '',
                abstract: '',
                content: '',
                navigation_id: '',
                sub_menu_id: '',
            },
            currentPage: null,
            generics: [],
            allgenerics: [],
            sub_menus: [],

        } 
    },

    actions: {
        generateSlug(menu) {
            return menu.toLowerCase().replace(/\s+/g, '-');
        },

        async save(){
            if (this.currentPage) {
            try {
                await axios.post('/save-page', this.currentPage);
                alert('Content saved successfully!');
            } catch (error) {
                console.error('Error saving article:', error);
                alert('Failed to save content.');
            }
            }
        }, 

        async fetchPagesData() {
            try {
                const response = await axios.post('/get-pages');
                this.allgenerics = response.data;
            } catch (error) {
                console.error('Error fetching pages data:', error);
            }
        },

        async deletePages(id) {
            if (!id) return;
            try {
              await axios.post('/delete-pages', { id });
              this.$reset();
              await this.fetchPagesData();
              alert('Page deleted successfully!');
            } catch (error) {
              console.error('Error deleting page:', error);
              alert('Failed to delete page.');
            }
        },

        async fetchPageData(id){
            try {
                const response = await axios.get(`/get-page/${id}`);
                this.generics = response.data;
            } catch (error) {
                console.error('Error fetching page data:', error);
            }
        },

        async editPageData(id){
            try {
                const response = await axios.get(`/edit-page/${id}`);
                this.currentPage = response.data;
            } catch (error) {
                console.error('Error fetching page data:', error);
            }
        }
    }   
});

