import toast from "./toast";
import axios from "axios";
export default {
    mixins: [toast],
    methods: {
        
        getHost(){
            let protocol = location.protocol;
            let slashes = protocol.concat("//");             
            return slashes.concat(window.location.host);
        },
        
        translate(key){
            return key;
        },
        
        loadItems() {
            this.getResults(this.currentPage);
        },
        
        loadValuesForm(){
            let app_url = this.getHost();

            this.$Progress.start()

            let url = `${app_url}/api/${this.Model}/form`;
            
            let response;
            
            response = this.form.get(url);    

            response.then(({data}) => {
                this.valuesForm = data['infos'];
                this.$Progress.finish();
            }).catch(({response}) => {
                this.$Progress.fail();
            });
            

        },
        
        create(model, item = {}) {
            this.$Progress.start()
            let app_url = this.getHost();

            let url = `${app_url}/api/${model}`;
            let method = 'post';
            if (this.isEdit) {
                method = 'put';
                url = `${app_url}/api/${model}/${this.form.id}`;
            }
            let response;
            try{
                 response = this.form[method](url)    
            } catch (e) {
                // console.log(e)

            }
             
            response.then(({data}) => {

                this.$refs['createModal'].hide()
                this.loadItems();
                this.toastMessage = this.translate(data.message);
                this.toastTitle = this.translate(data.variant.toUpperCase());
                this.toastVariant = data.variant??'success';
                this.toast();
                this.$Progress.finish()

            }).catch(({response}) => {
                this.toastMessage = this.translate(response.data.message);
                this.toastTitle = this.translate('Warning');
                this.toastVariant = 'warning';
                this.toast();
                this.$Progress.fail();

            });

        },
        
        delete(id, model) {
            let message = this.translate('It will not be possible to undo this action!')
            this.$bvModal.msgBoxConfirm(message, {
                title: this.translate("Do you want to delete this item?"),
                size: 'md',
                buttonSize: 'md',
                okVariant: 'danger',
                okTitle: this.translate('Delete'),
                cancelTitle: this.translate('Cancel'),
                footerClass: 'p-2',
                hideHeaderClose: false,
                centered: true
            })
            .then(value => {
                if (value){
                    this.form.delete(`api/${model}/${id}`).then(({data}) => {

                        this.loadItems()
                        this.toastMessage = data.message;
                        this.toastTitle = this.translate(data.variant.toUpperCase());
                        this.toastVariant = data.variant;
                        this.toast();

                    })
                    .catch(err => {
                        console.warn(err)
                    })
                }

            })
            .catch(err => {
                console.warn(err)
            })
        },
        
        validateEmail(email) {
            if (email){
                let parse_mail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return parse_mail.test(email);
            }
        },
        
        info(item, action) {

            if (action === 'delete') {
                this.delete(item.id, this.Model)
            }
            if (action === 'edit') {
                this.editForm(item, this.Model)
            }

        },
        
        clearForm() {
            this.isEdit = false;
            this.form.reset();
            this.form.clear();
        },
        
        editForm(item) {
            this.form.reset();
            this.form.clear();
            this.isEdit = true;
            this.form.fill(item);
            this.$refs['createModal'].show();
        },
        
        validation(field) {
            if (this.form.errors.has(field)){
                return !this.form.errors.has(field);
            }
        },
        
        clearError(field) {
            this.form.errors.clear(field)
        },
        
        getResults(page = 1) {
            this.$Progress.start();
            let response = axios.get(`api/${this.Model}`,{
                params: {
                    page:page
                }
            })
            return response.then(({ data }) => {
                this.rows = data.total;
                this.items = data;
                this.$Progress.finish();
                return this.items

            });

        },
        
    },

}