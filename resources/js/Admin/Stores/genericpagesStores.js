import axios from "axios";
import { defineStore } from "pinia";
import { ref } from "vue";

export const genericpagesStore = defineStore('generics', {
    state: () =>{
        return{
            form:{
                title:'',
                slug: '',
                abstract: '',
                content: '',
                navigation_id: '',
                sub_menu_id: '',
            },
            generics: [],
            allgenerics: [],
            sub_menus: [],

        } 
    },

    actions: {
        async save(){
            let {form} = this;
            try {
                await axios.post('/save-page', form);
                this.$reset();
                // Directly fetch updated data after saving
                await this.fetchPagesData();
            } catch (error) {
                console.error('Error saving sub navigation:', error);
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

        editPage(pagex){
            this.form = {...pagex};
        },

        async deletePages(pagex) {
            if (confirm('Are you sure you want to delete this page?')) {
                try {
                    await axios.post('/delete-pages', pagex);
                    // Directly fetch updated data after deletion
                    await this.fetchPagesData();
                } catch (error) {
                    console.error('Error deleting page:', error);
                }
            }
        },

        async fetchPageData(id){
            try {
                const response = await axios.get(`/get-page/${id}`);
                this.generics = response.data;
            } catch (error) {
                console.error('Error fetching page data:', error);
            }
        }
    }   
});

