 
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
        },
        start () {
            this.$Progress.start()
        },
        set (num) {
            this.$Progress.set(num)
        },
        increase (num) {
            this.$Progress.increase(num)
        },
        decrease (num) {
            this.$Progress.decrease(num)
        },
        finish () {
            this.$Progress.finish()
        },
        fail () {
            this.$Progress.fail()
        },
        test(){
            this.$Progress.start()

            this.$http.jsonp('http://api.rottentomatoes.com/api/public/v1.0/lists/movies/in_theaters.json?apikey=7waqfqbprs7pajbz28mqf6vz')
                .then((response) => {
                    this.$Progress.finish()
                }, (response) => {
                    this.$Progress.fail()
                })
        }
    },

}