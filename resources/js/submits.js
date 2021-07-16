 
export default {
    methods: {
        create(model) {
            
            this.form.post(`api/${model}`).then((response) => {
                console.log('Everything is awesome.',);
            }).catch((error) => {
                console.warn('Not good man :(');
            });
        },
        validateEmail() {
            if (this.form.email){
                let parse_mail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return parse_mail.test(this.form.email);
            }
        },
        onSubmit() {
            this.$v.form.$touch();
            if (this.$v.form.$anyError) {
                return;
            }

            alert("Form submitted!");
        }
    },

}