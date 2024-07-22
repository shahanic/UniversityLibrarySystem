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
        save(){
            let {form} = this;
            axios.post('/save-sub-nav', form).then(({data})=>{
                this.$reset();
                this.getter();
            });

        },
        getter(){
            axios.post('/get-sub-navs').then(({data})=>{
                this.navigations = data;
            })
        },
        editSubNav(subnavx){
            this.form = {...subnavx};
        },
        deleteSubNavs(subnavx){
            if(confirm('are you sure you want to delete this nav?')){
                axios.post('/delete-navs', subnavx).then(({data})=>{
                    this.getter();
                })
            }
        },
        async fetchSubNavData(id){
            try {
                const response = await axios.get(`/get-sub-nav/${id}`);
                this.sub_menus = response.data;
                
            } catch (error) {
                console.error('Error fetching sub navigation data:', error);
            }
        }
    }   
});

