import toast from "./toast";

export default {
    mixins: [toast],
    methods: {
        listLatest(model, progress = true) {
            progress?this.$Progress.start():'';
            axios.get(`api/${model}`).then(({data}) => {
                this.items = data.data;
                this.toastMessage = 'A lista foi atualizada';
            })
            progress?this.$Progress.finish():'';
        },
        create(model) {
            this.$Progress.start()
            this.form.post(`api/${model}`).then((response) => {
                this.$refs['createModal'].hide()
                this.listLatest(model, false);
                this.toastTitle = 'Item criado com sucesso';
                this.toastVariant = 'success';
                this.toast();

            }).catch((error) => {
                this.toastMessage = 'Reveja as informações no formulário';
                this.toastTitle = 'Item não foi salvo';
                this.toastVariant = 'danger';
                //console.warn('Not good man :(');       

                this.toast();
                this.$Progress.fail();

            });

            this.$Progress.finish()
        },
        delete(id, model) {
            this.$bvModal.msgBoxConfirm('Não será possível desfazer esta ação!', {
                title: "Deseja deletar  este item?",
                size: 'sm',
                buttonSize: 'md',
                okVariant: 'danger',
                okTitle: 'Deletar',
                cancelTitle: 'Cancelar',
                footerClass: 'p-2',
                hideHeaderClose: false,
                centered: true
            })
            .then(value => {
                if (value){
                    this.form.delete(`api/${model}/${id}`).then(({data}) => {

                        this.listLatest(model)
                        this.toastMessage = data.message;
                        this.toastTitle = data.variant.toUpperCase();
                        this.toastVariant = data.variant;
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
        cal(){
            this.toast();
        }
    },

}