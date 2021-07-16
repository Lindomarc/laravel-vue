export default {
    data(){
        return {
            toastTitle:'',
            toastMessage:'',
            toastVariant:''
        }
    },
    methods:{
        toast() {
            this.$bvToast.toast(this.toastMessage, {
                title: `${this.toastTitle || this.toastVariant}`,
                variant: this.toastVariant,
                solid: true
            });
            this.clearToast();
        },
        clearToast(){
            this.toastVariant = '';
            this.toastTitle = '';
            this.toastMessage = '';
        }
    }
}