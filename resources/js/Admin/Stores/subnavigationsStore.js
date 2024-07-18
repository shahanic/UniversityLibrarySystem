import axios from "axios";
import { defineStore } from "pinia";

export const subnavigationStore = defineStore('subnav', {
    state: () =>{
        return{
            form:{
                navigation_id:'',
                submenu: '',
            },

            
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

        

    }
});