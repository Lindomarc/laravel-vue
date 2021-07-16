 
export default {
    methods: {
        listLatest(model) {
            this.$Progress.start()
            axios.get(`api/${model}`).then(({data}) => {
                this.items = data.data;
            })
            this.$Progress.finish()
        },
        create(model) {
            this.$Progress.start()
            this.form.post(`api/${model}`).then((response) => {
                // console.log('Everything is awesome.');
                this.$refs['createModal'].hide()
            }).catch((error) => {
                //console.warn('Not good man :(');
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