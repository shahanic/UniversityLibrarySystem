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
        save(){
            let {form} = this;
            axios.post('/save-page', form).then(({data})=>{
                this.$reset();
                this.getter();
            });

        },
        getter(){
            axios.post('/get-pages').then(({data})=>{
                this.pages = data;
            })
        },
        editPage(pagex){
            this.form = {...pagex};
        },
        deletePages(pagex){
            if(confirm('are you sure you want to delete this page?')){
                axios.post('/delete-navs', pagex).then(({data})=>{
                    this.getter();
                })
            }
        },
        async fetchPageData(id){
            try {
                const response = await axios.get(`/get-page/${id}`);
                this.deletePages = response.data;
            } catch (error) {
                console.error('Error fetching sub navigation data:', error);
            }
        }
    }   
});

