import axios from "axios";
import { defineStore } from "pinia";
import { ref } from "vue";

export const pagesStores = defineStore('pages', {
    state: () =>{
        return{
            form:{
                name:'',
                code: '',
                nav_id: '',
                subnav_id: '',
            },
            pages: [],
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
                await this.fetchSubNavData();
            } catch (error) {
                console.error('Error saving sub navigation:', error);
            }
        },

        async fetchPagesData() {
            try {
                const response = await axios.post('/get-pages');
                this.pages = response.data;
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
                this.pages = response.data;
            } catch (error) {
                console.error('Error fetching page data:', error);
            }
        }
    }   
});