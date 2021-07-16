import toast from "./toast";

export default {
    mixins: [toast],
    methods: {
        listLatest(model, progress = true) {
            progress?this.$Progress.start():'';
            axios.get(`api/${model}`).then(({data}) => {
                this.items = data.data;
            })
            
            progress?this.$Progress.finish():'';
        },
        create(model) {
            this.$Progress.start()
            this.form.post(`api/${model}`).then((response) => {                
                this.$refs['createModal'].hide()
                this.listLatest(model,false);
                this.toast('Ele já foi listado','Item criado com sucesso', 'success');
            }).catch((error) => {
                //console.warn('Not good man :(');
                this.toast('Reveja as informações no formulário','Item não foi salvo', 'danger');
            });
            this.$Progress.finish()

        },
        validateEmail(email) {
            if (email){
                let parse_mail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return parse_mail.test(email);
            }
        }
    },

}