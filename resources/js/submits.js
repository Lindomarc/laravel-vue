import toast from "./toast";
import axios from "axios";

export default {
    mixins: [toast],
    
    methods: {
        translate(key){
            return key;
        },
        listLatest(model, progress = true) {
            progress?this.$Progress.start():'';
            axios.get(`api/${model}`).then(({data}) => {
                this.items = data.data;
            })
            progress?this.$Progress.finish():'';
        },
        create(model, item = {}) {
            this.$Progress.start()
            let url = `api/${model}`;
            let method = 'post';
            if (this.isEdit) {
                method = 'put';
                url = `api/${model}/${this.form.id}`;
            }
            let response;
            try{
                 response = this.form[method](url)    
            } catch (e) {
                console.log(e)

            }
             
            response.then(({data}) => {

                this.$refs['createModal'].hide()
                this.listLatest(model, false);
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

                        this.listLatest(model)
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
        }
    },

}