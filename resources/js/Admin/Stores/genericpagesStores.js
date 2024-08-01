import axios from "axios";
import { defineStore } from "pinia";
import { ref } from "vue";
// import { previousRoute } from '@/Admin/admin';

export const genericpagesStore = defineStore('generics', {
    state: () =>{
        return{
            isLayoutReady: true,
			config: null, // CKEditor needs the DOM tree before calculating the configuration.
            currentPage: null,
            newPage: {
                title:'',
                menu_title: '',
                slug: '',
                abstract: '',
                content: '',
                gallery_id: '',
                navigation_id: '',
                sub_menu_id: '',
            },
            generics: [],
            subnavs: [],
            navs: [],
            editing: false,
            adding: false,
            pagechecker: '',

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
                    // Navigate back based on previous route
                    this.editing = false;
                    this.adding = false;
                })
                .catch ((error) => {
                    console.error('Error saving article:', error);
                    alert('Failed to save content.');
                });
            }
        }, 
        

        // //genericpage
        // addPageData(){    
        //     this.newPage.slug = this.generateSlug(this.newPage.title);
        //     axios.post(`/save-new-page/${id}`, this.newPage)
        //     .then((response) => {
        //         this.newPage = response.data[0]||null;
        //         this.retrieveNavs();
        //         alert('Content saved successfully!');
        //     })
        //     .catch ((error) => {
        //         console.error('Error saving article:', error);
        //         alert('Failed to save content.');
        //     });
        // },


        // genericpages
        addNewPage(){
            this.newPage.slug = this.generateSlug(this.newPage.title);
            console.log(newPage);
            if (this.newPage) {
                    axios.post('/save-page', this.newPage)
                    .then(() => {
                        alert('Content saved successfully!');
                        // Navigate back based on previous route
                        this.adding = false;
                    })
                    .catch ((error) => {
                        console.error('Error saving article:', error);
                        alert('Failed to save content.');
                    });
            }
        }, 
        

        addPage(page, pagechecker){
            this.newPage = page;
            console.log(this.newPage.sub_menu_id);

            this.pagechecker = pagechecker;
            this.adding = true;
            if (this.pagechecker == 1){
                fetchSubAndNav(this.newPage.sub_menu_id);
            }
            
        },

        // retrieveEditPage($id), used in EditGenericPage.vue
        editPageData(id){
            axios.post(`/edit-page/${id}`)
            .then ((response) => {
                // console.log(response.data)
                // since response returns table(?), need to get array 0
                this.currentPage = response.data[0]||null;
                this.retrieveNavs();
            })
            .catch ((error) => {
                console.error('Error fetching page data:', error);
            })
        },

        editPage(page){
            console.log(page);
            this.currentPage = page;
            this.editing = true;
            
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
                // console.log(response.data)
                this.navs = response.data;
                // console.log(this.newPage)
                if (this.currentPage != null) {
                    this.retrieveSubNavs(this.currentPage.navigation_id);
                }
                else if(this.newPage.navigation_id) {
                    this.retrieveSubNavs(this.newPage.navigation_id);
                }
                else{
                    this.subnavs = [];
                }
            })
            .catch(error => {
                console.error('Error retrieving navigation:', error);
                throw error;
            });
        },

        // deletePages(Request $request), used in all vue genericpages
        deletePages(page, pagechecker) {
            console.log(page);
            if (!page.id) return;
            if (confirm('Are you sure you want to delete this page?')){
                axios.post('/delete-pages', { id: page.id })
                .then((response) => {
                    if (response.data.code === 1){
                        alert('Page deleted successfully!');
                        if(pagechecker == 1){
                            this.fetchPageData(page.sub_menu_id);
                        }else{
                            this.fetchPagesData();
                        }
                    }      
                })
                .catch ((error) => {
                    console.error('Error deleting page:', error);
                    alert('Failed to delete page.');
                })
            }
        },

        // retrieveAllPages(), used in GenericPages.vue
        fetchPagesData() {
            this.$reset();
            axios.post('/get-pages')
            .then((response) => {
                this.generics = response.data;
            })
            .catch ((error) => {
                console.error('Error fetching pages data:', error);
            });
        },

        // retrievePages($id), used in GenericPage.vue
        fetchPageData(id){
            this.$reset();
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

