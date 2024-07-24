import { defineStore } from "pinia";
import axios from "axios";
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
                await this.fetchSubNavData();
            } catch (error) {
                console.error('Error saving sub navigation:', error);
            }
        },

        async fetchSubNavData() {
            try {
                const response = await axios.post('/get-sub-navs');
                this.navigations = response.data;
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
                    await axios.post('/delete-navs', subnavx);
                    // Directly fetch updated data after deletion
                    await this.fetchSubNavData();
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