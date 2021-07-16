import toast from "./toast";

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
        create(model) {
            this.$Progress.start()
            this.form.post(`api/${model}`).then(({data}) => {
                this.$refs['createModal'].hide()
                this.listLatest(model, false);
                this.toastMessage = this.translate(data.message);
                this.toastTitle = this.translate(data.variant.toUpperCase());
                this.toastVariant = data.variant;
                this.toast();

            }).catch((error) => {
                this.toastMessage = this.translate('Review the information on the form.');
                this.toastTitle = this.translate('Item not saved');
                this.toastVariant = 'danger';
                //console.warn('Not good man :(');       

                this.toast();
                this.$Progress.fail();

            });

            this.$Progress.finish()
        },
        delete(id, model) {
            let message = this.translate('It will not be possible to undo this action!')
            this.$bvModal.msgBoxConfirm(message, {
                title: this.translate("Do you want to delete this item?"),
                size: 'sm',
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
        },
        calcu(){
            this.toast();
        }
    },

}