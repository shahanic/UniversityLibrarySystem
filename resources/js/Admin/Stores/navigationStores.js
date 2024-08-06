import axios from "axios";
import { defineStore } from "pinia";

export const navigationStore = defineStore('nav', {
    state: () =>{
        return{
            form:{
                menu: '',
                slug: '',

            },
            navigations: [],
            sub_menus: [],
            showModal: false,
        }
    },

    actions: {
        generateSlug(menu) {
            return menu.toLowerCase().replace(/\s+/g, '-');
        },

        addnewnav(){
            console.log(this.showModal);
            this.showModal = true;
        },

        save(){
            let {form} = this;
            form.slug = this.generateSlug(form.menu);
            axios.post('/save-nav', form).then(({data})=>{
                this.$reset();
                this.getter();
            })
            .catch((error) => {
                console.error('An error occurred:', error);
                alert('Something went wrong. Please try again later.');
            })
        },

        getter(){
            axios.post('/get-navs').then(({data})=>{
                this.navigations = data;
            })
            .catch((error) => {
                console.error('An error occurred:', error);
                alert('Something went wrong. Please try again later.');
            })
        },

        editNav(navx){
            this.form = {...navx};
        },

        deleteNavs(navx){
            if(confirm('are you sure you want to delete this nav?')){
                axios.post('/delete-navs', navx).then(({data})=>{
                    this.getter();
                })
                .catch((error) => {
                    console.error('An error occurred:', error);
                    alert('Something went wrong. Please try again later.');
                })
            }
        },



    }
});