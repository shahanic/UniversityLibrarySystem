// import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import axios from "axios";
import { defineStore } from "pinia";
import { ref } from "vue";

export const genericpagesStore = defineStore('generics', {
    state: () =>{
        return{
            isLayoutReady: true,
			config: null, // CKEditor needs the DOM tree before calculating the configuration.
            currentPage: null,
            newPage: {
                title:'',
                slug: '',
                abstract: '',
                content: '',
            },
            generics: [],
            allgenerics: [],
            subnavs: [],
            navs: [],

        } 
    },

    actions: {
        generateSlug(title) { 
            return title.toLowerCase().replace(/\s+/g, '-'); 
        },

        // save from edit
        save(){
            this.currentPage.slug = this.generateSlug(this.currentPage.title);
            if (this.currentPage) {
                axios.post('/save-page', this.currentPage)
                .then(() => {
                    alert('Content saved successfully!');
                })
                .catch ((error) => {
                    console.error('Error saving article:', error);
                    alert('Failed to save content.');
                });
            }
        }, 

        //
        addPageData(id){    
            this.newPage.slug = this.generateSlug(this.newPage.title);
            axios.post(`/save-new-page/${id}`, this.newPage)
            .then((response) => {
                this.newPage = response.data[0]||null;
                alert('Content saved successfully!');
            })
            .catch ((error) => {
                console.error('Error saving article:', error);
                alert('Failed to save content.');
            });
        },


        // retrieveEditPage($id), used in EditGenericPage.vue
        editPageData(id){
            axios.post(`/edit-page/${id}`)
            .then ((response) => {
                // since response returns table(?), need to get array 0
                this.currentPage = response.data[0]||null;
                this.retrieveNavs();
            })
            .catch ((error) => {
                console.error('Error fetching page data:', error);
            })
        },

        retrieveSubNavs(id) {
        axios.post(`/retrieve-sub-navs/${id}`)
            .then(response => {
            // console.log(response.data);
            this.subnavs = response.data; // Assuming response.data is the filtered subnavs
            })
            .catch(error => {
            console.error('Error retrieving sub navigation:', error);
            throw error;
            });
        },

        retrieveNavs(){
            axios.post('/retrieve-navs') 
            .then(response => {
                this.navs = response.data;
                if (this.currentPage.navigation_id) {
                    this.retrieveSubNavs(this.currentPage.navigation_id);
                } else{
                    this.subnavs = [];
                }
            })
            .catch(error => {
                console.error('Error retrieving navigation:', error);
                throw error;
            });
        },

        

        // deletePages(Request $request), used in all vue genericpages
        deletePages(id) {
            if (!id) return;
            axios.post('/delete-pages', { id })
            .then(() => {
                this.$reset();
                //FIXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
                // FIXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
                this.fetchPagesData();
                alert('Page deleted successfully!');
            })
            .catch ((error) => {
                console.error('Error deleting page:', error);
                alert('Failed to delete page.');
            })
        },

        // retrieveAllPages(), used in GenericPages.vue
        fetchPagesData() {
            axios.post('/get-pages')
            .then((response) => {
                this.allgenerics = response.data;
            })
            .catch ((error) => {
                console.error('Error fetching pages data:', error);
            });
        },

        // retrievePages($id), used in GenericPage.vue
        fetchPageData(id){
            axios.post(`/get-page/${id}`)
            .then ((response) => {
                this.generics = response.data;
            })
            .catch ((error) => {
                console.error('Error fetching page data:', error);
            })
        },

    }  

});

