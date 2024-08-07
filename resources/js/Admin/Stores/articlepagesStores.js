// import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import { defineStore } from 'pinia';
import axios from 'axios';
import AddArticle from '../Modals/AddArticle.vue';

export const articlesStore = defineStore('articles', {
  state: () => ({
    isLayoutReady: true,
    currentArticle: null,
    newArticle: {
      title: '',
      abstract: '',
      slug: '',
      content: '',
      type: '',
      status: '',
      gallery_id: '', 
      date: new Date().toISOString().split('T')[0],
    },
    articles: [],
    adding: false,
    editing: false,
    preview: false,
    previewArticle: null,
    //for photos
    photos: [],
    isAddImageModalOpen: false,
    form: {
      name: '',
      type: '',
      src: [],
    },
    oldestFirst: false,
  }),

  actions: {
    handleFileUploadss(event) {
      const files = event.target.files;

        //  this.form.src = Array.from(files); 
         this.form.src = [...this.form.src, ...files];
    },

    

    generateSlug(title) {
      if (title) {
        return title
          .toLowerCase()
          .replace(/\s+/g, '-')
          .replace(/[^\w\-]+/g, ''); // Remove non-word characters
      }
      return ''; // Return an empty string or a default value if title is not defined
    },

    addNewArticle() {
      this.newArticle.slug = this.generateSlug(this.newArticle.title); // Generate slug
      if (this.newArticle) {
        axios.post('/save-article', this.newArticle)
          .then(response => {
            const article = response.data;
            // Proceed to upload images if any
            if (this.form.src && this.form.src.length > 0) {
               const formData = new FormData();
              console.log(formData);
              formData.append('gallery_id', article.gallery_id);
              formData.append('name', article.title);
              formData.append('slug', article.slug);
              formData.append('type', '1'); // Add the type field with value 1
         

              for (let i = 0; i < this.form.src.length; i++) {
                formData.append('src[]', this.form.src[i]); // Append files to FormData
              }
    
              axios.post(`/save-images-art/${article.gallery_id}/${article.slug}/${1}`, formData, {
                headers: {
                  'Content-Type': 'multipart/form-data'
                }
              })
              .then(() => {
                alert('Content and images saved successfully!');
                this.adding = false;
              })
              .catch(error => {
                console.error('Error saving images:', error);
                alert('Failed to save images.');
              });
            } else {
              alert('Content saved successfully!');
              this.adding = false;
            }
          })
          .catch(error => {
            console.error('Error saving article:', error);
            alert('Failed to save content.');
          });
      }
    },

    cancel(){
      this.editing = false;
      this.adding = false;    
      this.preview = false;
    },

    previewContent(id){
      this.preview = true;
      axios.post(`/edit-article/${id}`)
        .then((response) =>{
          this.previewArticle = {
            title: response.data[0].title,
            content: response.data[0].content
          };

        })
        .catch((error) => {
          console.error('Error fetching article data:', error);
        })
    },

    addArticle(article){
      this.newArticle = article;
      this.adding = true;
    },


    editArticle(article){
      console.log(article); 
      this.currentArticle = article;
      this.editing = true;
    },

    editArticleData(id){
        axios.post(`/edit-article/${id}`)
        .then((response) =>{
          this.currentPage = response.data[0]||null;
        })
        .catch((error) => {
          console.error('Error saving article:', error);
          alert('Failed to save content.');
        })
    },

    save(){
      this.currentArticle.slug = this.generateSlug(this.currentArticle.title);
      if (this.currentArticle){
        axios.post('/save-article', this.currentArticle)
        .then(() =>{
          alert('Content saved successfully!');
          this.editing = false;
        })
        .catch((error) => {
          console.error('Error saving article:', error);
          alert('Failed to save content.');
        })
      }
    },

    fetchArticlesData(){
      this.$reset();
      axios.post('/get-articles')
      .then((response) => {
        this.articles = response.data;
        
      })
      .catch((error) => {
        console.error('Error fetching articles:', error);

      })
    },

    deleteArticle(id){
      if (!id) return;
      if (confirm('Are you sure you want to delete this page?')){
      axios.post('/delete-article', { id })
      .then(() => {
        this.$reset();
        this.fetchArticlesData();
        alert('Article deleted successfully!');
      })
      .catch((error) => {
        console.error('Error deleting article:', error);
        alert('Failed to delete article.');
      })
    }
    },

    fetchArticleData(id){
      axios.get(`/get-article/${id}`)
      .then((response) => {
        this.currentArticle = response.data[0]||null;
      })
      .catch((error) => {
        console.error('Error fetching article data:', error);
      })
    },

  }
});
