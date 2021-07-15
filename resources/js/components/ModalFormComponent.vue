<template>
  <div class="modal fade" v-bind:id="modal" tabindex="-1" v-bind:aria-labelledby="formModalLabel()" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" v-bind:id="formModalLabel()">{{title}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
          <slot/>
          
        </div>
        <div class="modal-footer   justify-content-between">
          <button type="submit" class="btn btn-primary">Salvar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['title','modal'],
  data(){
    return {
      formModalLabel:()=>{
        return `${this.modal}Label`
      }
    }
  },
  mounted() {
   // console.log('Modal Component mounted.')
  }
}
</script>
