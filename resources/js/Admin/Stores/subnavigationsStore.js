import axios from "axios";
import { defineStore } from "pinia";
import { ref } from "vue";

export const subnavigationsStore = defineStore('subnav', {
    state: () =>{
        return{
            form:{
                navigation_id:'',
                submenu: '',
            },
            sub_menus: [],
            navigations: [],

        } 
    },

    actions: {
        async save(){
            let {form} = this;
            try {
                await axios.post('/save-sub-nav', form);
                this.$reset();
                // Directly fetch updated data after saving
                await this.fetchSubNavsData();
            } catch (error) {
                console.error('Error saving sub navigation:', error);
            }
        },

        async fetchSubNavsData() {
            try {
                const response = await axios.post('/get-sub-navs');
                this.sub_menus = response.data;
            } catch (error) {
                console.error('Error fetching sub navigation data:', error);
            }
        },

        editSubNav(subnavx){
            this.form = {...subnavx};
        },

        async deleteSubNavs(subnavx) {
            if (confirm('Are you sure you want to delete this subnav?')) {
                try {
                    await axios.post('/delete-sub-navs', subnavx);
                    // Directly fetch updated data after deletion
                    await this.fetchSubNavsData();
                } catch (error) {
                    console.error('Error deleting sub navigation:', error);
                }
            }
        },

        async fetchSubNavData(id) {
            try {
                const response = await axios.get(`/get-sub-nav/${id}`);
                this.sub_menus = response.data;
            } catch (error) {
                console.error('Error fetching sub navigation data:', error);
            }
        }
    }   
});

