import { defineStore } from "pinia";
import axios from "axios";
import { ref } from "vue";

export const subnavigationsStore = defineStore('subnav', {
    state: () =>{
        return{
            form:{
                navigation_id:'',
                submenu: '',
                slug: '',
            },
            sub_menus: [],
            navigations: [],
            editing: false,

        } 
    },

    actions: {
        //edit and add
        generateSlug(menu) {
            return menu.toLowerCase().replace(/\s+/g, '-');
        },

        fetchSubNavData(id) {
            axios.get(`/get-sub-nav/${id}`)
            .then((response) => {
                if (response.data.length > 0) {
                    this.form.navigation_id = response.data[0].nav_id || ''; // Default to empty string if nav_id is not present
                    this.sub_menus = response.data;
                } else {
                    // Handle case where no data is found
                    this.form.navigation_id = '';
                    this.sub_menus = [];
                    console.warn('No sub-navigation data found for ID:', id);
                }
            })
            .catch ((error) => {
                console.error('Error fetching sub navigation data:', error);

            })
        }, 

        save(id){
            let {form} = this;
            form.slug = this.generateSlug(form.submenu);
            form.navigation_id = id;
            const response = axios.post(`/save-sub-nav`, form).then(({data})=>{
                this.$reset();
                this.fetchSubNavData(form.navigation_id);
            });
        },

        fetchSubNavsData() {
            axios.post('/get-sub-navs')
            .then((response) => {
                this.navigations = response.data;
            })
            .catch((error) => {
                console.error('Error fetching sub navigation data:', error);
            })
        },

        editSubNav(subnavx){
            this.form = {...subnavx};
        },
        

        getter(){
            axios.post('/get-sub-navs').then(({data})=>{
                this.sub_menus = data;
            })
        },


        deleteSubNav(subnavx) {
            if (confirm('Are you sure you want to delete this subnav?')) {
                axios.post('/delete-sub-navs', subnavx)
                .then(() => {
                    if (subnavx.nav_id) {
                        this.fetchSubNavData(subnavx.nav_id);
                    } else {
                        // Optionally, fetch all sub-navigations or handle empty state
                        this.fetchSubNavsData();
                    }
                })
                .catch ((error) => { 
                    console.error('Error deleting sub navigation:', error)
                })
            }
        },
    }   
});