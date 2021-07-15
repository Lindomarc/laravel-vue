export default {
    methods:{
        create(model){
            this.form.post(`api/${model}`);
        }
    },
}